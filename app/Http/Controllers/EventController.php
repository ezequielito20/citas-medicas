<?php

namespace App\Http\Controllers;

use App\Models\Hour;
use App\Models\Event;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validar los datos de la solicitud
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date|after_or_equal:today',
            // 'hour' => ['required', 'string', 'max:20'],
            'hour' => ['required', 'regex:/^(0[8-9]|1[0-9]|19):[0-5][0-9]$/', 'string', 'max:20'],
            // 'office_id' => 'required|exists:offices,id',
        ], [
            'doctor_id.required' => 'El doctor es obligatorio.',
            'doctor_id.exists' => 'El doctor seleccionado no existe.',
            'date.required' => 'La fecha es obligatoria.',
            'date.date' => 'La fecha debe ser válida.',
            'date.after_or_equal' => 'La fecha debe ser hoy o una fecha futura.',
            'hour.required' => 'La hora es obligatoria.',
            'hour.string' => 'La hora debe ser un texto válido.',
            'hour.max' => 'La hora no debe exceder los 20 caracteres.',
            'hour.regex' => 'La hora debe estar en un formato válido y estar entre las 08:00 y las 19:59.',
            // 'office_id.required' => 'El consultorio es obligatorio.',
            // 'office_id.exists' => 'El consultorio seleccionado no existe.',
        ]);

        // Obtener el doctor relacionado
        $doctor = Doctor::find($validated['doctor_id']);
        $reservation_date = $request->input('date');
        $reservation_hour = $request->input('hour');
        $dayOfWeek = Carbon::parse($reservation_date)->format('l'); // Obtiene el nombre del día en inglés

        // Si deseas el nombre del día en español
        $dayOfWeek = Carbon::parse($reservation_date)->locale('es')->isoFormat('dddd');
        $hours = Hour::where('doctor_id', $doctor->id)
            ->where('day', $dayOfWeek)
            ->where('start_time', '<=', $reservation_hour)
            ->where('end_time', '>=', $reservation_hour)
            ->exists();
        if (!$hours) {
            throw ValidationException::withMessages([
                'hour' => ['El doctor no esta disponible en ese horario'],
            ]);
        }

        // validacion de eventos duplicados 
        $duplicate_events = Event::where('doctor_id', $doctor->id)
                            ->where('start',$reservation_date." ".$reservation_hour)
                            ->exists();
        
        if ($duplicate_events) {
            throw ValidationException::withMessages([
                'hour' => ['El doctor ya tiene un evento en ese horario y fecha'],
                
            ]);
        }

        try {
            // Crear el evento
            Event::create([
                'title' => $validated['hour'] . " - " . $doctor->specialization,
                'start' => $validated['date'] . " " . $validated['hour'],
                'end' => $validated['date'] . " " . $validated['hour'],
                'color' => "#ff0000",
                'user_id' => Auth::user()->id,
                'doctor_id' => $validated['doctor_id'],
                'office_id' => '1',
            ]);

            // Redirigir con mensaje de éxito
            return redirect()->route('admin.index')
                ->with('message', 'Evento creado correctamente.')
                ->with('icons', 'success');
        } catch (\Exception $e) {
            return redirect()->route('admin.index')
                ->withErrors($e->getMessage()) // Pasar los errores al formulario
                ->with('message', 'Hubo un problema al crear el doctor.')
                ->with('icons', 'error');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->to(url()->previous())
        ->with('message', 'Evento eliminado correctamente.')
        ->with('icons', 'success');
    }
}
