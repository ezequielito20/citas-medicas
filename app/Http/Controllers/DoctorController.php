<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Hour;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Office;
use Illuminate\Http\Request;
use App\Models\Configuration;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
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
        $offices = Office::all();
        return view('admin.doctors.create', compact('offices'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            // Validación datos de usuario
            'username' => 'required|string|max:255|unique:users,name',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:5|confirmed',
            
            // Validación datos de doctor
            'name' => 'required|string|max:100',
            'last_names' => 'required|string|max:100',
            'phone' => 'nullable|string|max:30',
            'medical_leave' => 'required|string|max:190',
            'specialization' => 'required|string|max:190',
            'office_id' => 'required|exists:offices,id',
        ], [
            'username.required' => 'El nombre de usuario es obligatorio.',
            'username.unique' => 'Este nombre de usuario ya está en uso.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'Este correo electrónico ya está en uso.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'name.required' => 'El nombre es obligatorio.',
            'last_names.required' => 'Los apellidos son obligatorios.',
            'medical_leave.required' => 'La licencia médica es obligatoria.',
            'specialization.required' => 'La especialidad es obligatoria.',
            'office_id.required' => 'El consultorio es obligatorio.',
            'office_id.exists' => 'El consultorio seleccionado no existe.',
        ]);

        try {
            // Crear el usuario
            $user = User::create([
                'name' => $validated['username'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
            ]);

            // Crear el doctor y asociarlo al usuario
            Doctor::create([
                'names' => $validated['name'],
                'last_names' => $validated['last_names'],
                'phone' => $validated['phone'] ?? null,
                'medical_leave' => $validated['medical_leave'],
                'specialization' => $validated['specialization'],
                'user_id' => $user->id,
                'office_id' => $validated['office_id'],
            ]);

            // Asignar el rol
            $user->assignRole('doctor');

            return redirect()->route('admin.doctors.index')
                ->with('message', 'Doctor creado correctamente.')
                ->with('icons', 'success');
        } catch (\Exception $e) {
            return redirect()->route('admin.doctors.create')
                ->with('message', 'Hubo un problema al crear el doctor: ' . $e->getMessage())
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

    public function pdf()
    {
        $doctors = Doctor::with('user')->get();
        $configuration = Configuration::latest()->first();
        
        $pdf = \PDF::loadView('admin.doctors.pdf', compact('configuration', 'doctors'));
        
        // Obtener el objeto DOMPDF
        $pdf->output();
        $dompdf = $pdf->getDomPDF();
        $canvas = $dompdf->getCanvas();
        
        // Agregar número de página y fecha en el pie de página
        $canvas->page_text(20, 800, "Impreso por: " . Auth::user()->name, null, 10, array(0,0,0));
        $canvas->page_text(270, 800, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0,0,0));
        $canvas->page_text(450, 800, "Fecha: " . \Carbon\Carbon::now()->format('d/m/Y')." ". \Carbon\Carbon::now()->format('H:i:s'), null, 10,array(0,0,0) 
        );

        return $pdf->stream();
    }
}
