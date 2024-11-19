<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Office;
use Illuminate\Http\Request;
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
        return view('admin.doctors.index',compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $offices = Office::all();
        return view('admin.doctors.create',compact('users','offices'));
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
            'phone' => 'nullable|string|max:100',
            'medical_leave' => 'required|string|max:190',
            'specialization' => 'required|string|max:190',
            'user_id' => 'required|exists:users,id',
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
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        //
    }
}
