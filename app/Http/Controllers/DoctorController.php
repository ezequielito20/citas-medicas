<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Hour;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::with('user')->get();
        return view('admin.doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $offices = Office::all();
        return view('admin.doctors.create', compact('users', 'offices'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'last_names' => 'required|string|max:100',
            'phone' => 'nullable|string|max:30',
            'medical_leave' => 'required|string|max:190',
            'specialization' => 'required|string|max:190',
            'user_id' => [
                'required',
                'exists:users,id',
                Rule::unique('doctors', 'user_id')->ignore($request->id),
            ],
            'office_id' => 'required|exists:offices,id',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'last_names.required' => 'Los apellidos son obligatorios.',
            'medical_leave.required' => 'La licencia médica es obligatoria.',
            'specialization.required' => 'La especialidad es obligatoria.',
            'user_id.required' => 'El usuario es obligatorio.',
            'user_id.exists' => 'El usuario seleccionado no existe.',
            'office_id.required' => 'El consultorio es obligatorio.',
            'office_id.exists' => 'El consultorio seleccionado no existe.',
        ]);

        try {
            // Crear el doctor con los datos validados
            Doctor::create([
                'names' => $validated['name'],
                'last_names' => $validated['last_names'],
                'phone' => $validated['phone'] ?? null,
                'medical_leave' => $validated['medical_leave'],
                'specialization' => $validated['specialization'],
                'user_id' => $validated['user_id'], // Asociar el usuario
                'office_id' => $validated['office_id'], // Asociar el consultorio
            ]);

            // Obtener el usuario asociado
            $user = User::find($validated['user_id']);

            // Asignar el rol al usuario
            $user->assignRole('doctor');

            // Redirigir con mensaje de éxito
            return redirect()->route('admin.doctors.index')
                ->with('message', 'Doctor creado correctamente.')
                ->with('icons', 'success');
        } catch (\Exception $e) {
            // Si ocurre un error, redirigir con mensaje de error
            return redirect()->route('admin.doctors.create')
                ->with('message', 'Hubo un problema al crear el doctor.')
                ->with('icons', 'error');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $doctor = Doctor::with(['user', 'hours', 'office'])->findOrFail($id);
        return view('admin.doctors.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $doctor = Doctor::with(['user', 'hours', 'office'])->findOrFail($id);
        $users = User::all();
        $hours = Hour::all();
        $offices = Office::all();
        return view('admin.doctors.edit', compact('doctor', 'users', 'hours', 'offices'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Encuentra el doctor por ID o lanza una excepción si no se encuentra
        $doctor = Doctor::findOrFail($id);

        // Valida los datos de entrada
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'last_names' => 'required|string|max:100',
            'phone' => 'nullable|string|max:100',
            'medical_leave' => 'required|string|max:190',
            'specialization' => 'required|string|max:190',
            'user_id' => [
                'required',
                'exists:users,id',
                Rule::unique('doctors', 'user_id')->ignore($doctor->id),
            ],
            'office_id' => [
                'required',
                'exists:offices,id',
            ],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'last_names.required' => 'Los apellidos son obligatorios.',
            'medical_leave.required' => 'La licencia médica es obligatoria.',
            'specialization.required' => 'La especialización es obligatoria.',
            'user_id.required' => 'El usuario es obligatorio.',
            'user_id.exists' => 'El usuario seleccionado no existe.',
            'user_id.unique' => 'El usuario ya está asociado a otro doctor.',
            'office_id.required' => 'El consultorio es obligatorio.',
            'office_id.exists' => 'El consultorio seleccionado no existe.',
        ]);

        try {
            // Actualiza el doctor con los datos validados
            $doctor->update([
                'names' => $validated['name'],
                'last_names' => $validated['last_names'],
                'phone' => $validated['phone'] ?? $doctor->phone,
                'medical_leave' => $validated['medical_leave'],
                'specialization' => $validated['specialization'],
                'user_id' => $validated['user_id'], // Actualiza el usuario asociado
                'office_id' => $validated['office_id'], // Actualiza el consultorio asociado
            ]);

            // Redirige a la lista de doctores con un mensaje de éxito
            return redirect()->route('admin.doctors.index')
                ->with('message', 'Doctor actualizado correctamente.')
                ->with('icons', 'success');
        } catch (\Exception $e) {
            // Si ocurre un error, redirige con mensaje de error
            return redirect()->route('admin.doctors.edit', $doctor->id)
                ->with('message', 'Hubo un problema al actualizar el doctor.')
                ->with('icons', 'error');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();
        return redirect()->route('admin.doctors.index')
        ->with('message', 'Doctor eliminado correctamente.')
        ->with('icons', 'success');
    }

    public function reports(){
        return view('admin.doctors.reports');
    }

    public function pdf(){
        $pdf = \PDF::loadView('admin.doctors.pdf');
        return $pdf->stream();
    }
}
