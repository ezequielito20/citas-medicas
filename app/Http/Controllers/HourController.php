<?php

namespace App\Http\Controllers;

use App\Models\Hour;
use App\Models\Doctor;
use App\Models\Office;
use Illuminate\Http\Request;
use App\Http\Requests\StoreHourRequest;
use App\Http\Requests\UpdateHourRequest;

class HourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offices = Office::all();
        $hours = Hour::with('doctor', 'office')->get();
        return view('admin.hours.index', compact('hours', 'offices'));
    }

    public function offices_data($id){
        try {
            $hours = Hour::with('doctor', 'office')->where('office_id', $id)->get();
            return view('admin.hours.offices_data', compact('hours'));
        } catch (\Throwable $th) {
            //throw $th;
        }
        // $office = Office::findOrFail($id);
        // return view('admin.hours.offices_data', compact('office'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $doctors = Doctor::all();
        $offices = Office::all();
        $hours = Hour::with('doctor', 'office')->get();
        return view('admin.hours.create', compact('doctors', 'offices', 'hours'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos enviados desde el formulario
        $validatedData = $request->validate([
            'day' => 'required|string|max:100|in:Lunes,Martes,Miercoles,Jueves,Viernes,Sabado',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'doctor_id' => 'required|exists:doctors,id',
            'office_id' => 'required|exists:offices,id',
        ], [
            // Mensajes de error personalizados
            'day.required' => 'El día es obligatorio.',
            'day.in' => 'El día no es válido.',
            'start_time.required' => 'La hora de inicio es obligatoria.',
            'start_time.date_format' => 'El formato de la hora de inicio no es válido.',
            'end_time.required' => 'La hora de fin es obligatoria.',
            'end_time.date_format' => 'El formato de la hora de fin no es válido.',
            'end_time.after' => 'La hora de fin debe ser posterior a la hora de inicio.',
            'doctor_id.required' => 'Debes seleccionar un doctor.',
            'doctor_id.exists' => 'El doctor seleccionado no es válido.',
            'office_id.required' => 'Debes seleccionar un consultorio.',
            'office_id.exists' => 'El consultorio seleccionado no es válido.',
        ]);

        // Validar solapamiento de horarios excluyendo los límites
        $hasConflict = Hour::where('day', $validatedData['day'])
            ->where('office_id', $validatedData['office_id'])
            ->where(function ($query) use ($validatedData) {
                $query->where(function ($query) use ($validatedData) {
                    // El nuevo rango empieza dentro de un rango existente
                    $query->where('start_time', '<', $validatedData['end_time'])
                        ->where('end_time', '>', $validatedData['start_time']);
                })->orWhere(function ($query) use ($validatedData) {
                    // El nuevo rango engloba un rango existente
                    $query->where('start_time', '>', $validatedData['start_time'])
                        ->where('start_time', '<', $validatedData['end_time']);
                });
            })
            ->exists();

        if ($hasConflict) {
            return redirect()->back()
                ->withInput()
                ->with('message', 'Ya existe un horario que se superpone con el rango de tiempo ingresado en este consultorio.')
                ->with('icons', 'error');
        }

        try {
            // Crear el horario en la base de datos
            Hour::create([
                'day' => $validatedData['day'],
                'start_time' => $validatedData['start_time'],
                'end_time' => $validatedData['end_time'],
                'doctor_id' => $validatedData['doctor_id'],
                'office_id' => $validatedData['office_id'],
            ]);

            // Redirigir con mensaje de éxito
            return redirect()->route('admin.hours.index')
                ->with('message', 'Horario creado exitosamente.')
                ->with('icons', 'success');
        } catch (\Exception $e) {
            // Si ocurre un error, redirigir con mensaje de error
            return redirect()->route('admin.hours.create')
                ->with('message', 'Hubo un problema al crear el horario. Por favor, intente nuevamente.')
                ->with('icons', 'error');
        }
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hour = Hour::with('doctor', 'office')->findOrFail($id);
        return view('admin.hours.show', compact('hour'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHourRequest $request, Hour $hour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hour $hour)
    {
        //
    }
}
