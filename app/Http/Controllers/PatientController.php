<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::all();
        return view('admin.patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.patients.create');
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
            'ci' => 'required|string|max:9|unique:patients,ci',
            'email' => 'required|email|max:100|unique:patients,email',
            'phone' => 'nullable|string|max:20',
            'birthdate' => 'nullable|date',
            'gender' => 'nullable|string|in:M,F',
            'blood_type' => 'nullable|string|max:20',
            'allergies' => 'nullable|string|max:190',
            'emergency_contact' => 'nullable|string|max:100',
            'health_insurance_number' => 'nullable|string|max:100',
            'observations' => 'nullable|string|max:190',
            'address' => 'nullable|string|max:190',
        ], [
            // Mensajes personalizados
            'name.required' => 'El nombre es obligatorio.',
            'last_names.required' => 'Los apellidos son obligatorios.',
            'ci.required' => 'El campo C.I es obligatorio.',
            'ci.unique' => 'Este C.I ya está registrado.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo electrónico no es válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'gender.in' => 'El género seleccionado no es válido.',
        ]);

        try {
            // Crear el registro del paciente
            Patient::create([
                'names' => $validated['name'],
                'last_names' => $validated['last_names'],
                'ci' => $validated['ci'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'birthdate' => $validated['birthdate'] ?? null,
                'gender' => $validated['gender'] ?? null,
                'blood_type' => $validated['blood_type'] ?? null,
                'allergies' => $validated['allergies'] ?? null,
                'emergency_contact' => $validated['emergency_contact'] ?? null,
                'health_insurance_number' => $validated['health_insurance_number'] ?? null,
                'observations' => $validated['observations'] ?? null,
                'address' => $validated['address'] ?? null,
            ]);

            // Redirigir con mensaje de éxito
            return redirect()->route('admin.patients.index')
                ->with('message', 'Paciente creado correctamente.')
                ->with('icons', 'success');
        } catch (\Exception $e) {
            // Manejar errores
            return redirect()->route('admin.patients.create')
                ->with('message', 'Hubo un problema al crear el paciente.')
                ->with('icons', 'error');
        }
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $patient = Patient::findOrFail($id);
        return view('admin.patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return view('admin.patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Encuentra el paciente por ID o lanza una excepción si no se encuentra
    $patient = Patient::findOrFail($id);

    // Validar los datos del formulario
    $validated = $request->validate([
        'name' => 'required|string|max:100',
        'last_names' => 'required|string|max:100',
        'ci' => [
            'required',
            'string',
            'max:9',
            Rule::unique('patients', 'ci')->ignore($patient->id),
        ],
        'email' => [
            'required',
            'email',
            'max:100',
            Rule::unique('patients', 'email')->ignore($patient->id),
        ],
        'phone' => 'nullable|string|max:20',
        'birthdate' => 'nullable|date',
        'gender' => 'nullable|string|in:M,F',
        'blood_type' => 'nullable|string|max:20',
        'allergies' => 'nullable|string|max:190',
        'emergency_contact' => 'nullable|string|max:100',
        'health_insurance_number' => 'nullable|string|max:100',
        'observations' => 'nullable|string|max:190',
        'address' => 'nullable|string|max:190',
    ], [
        // Mensajes personalizados
        'name.required' => 'El nombre es obligatorio.',
        'last_names.required' => 'Los apellidos son obligatorios.',
        'ci.required' => 'El campo C.I es obligatorio.',
        'ci.unique' => 'Este C.I ya está registrado.',
        'email.required' => 'El correo electrónico es obligatorio.',
        'email.email' => 'El formato del correo electrónico no es válido.',
        'email.unique' => 'Este correo electrónico ya está registrado.',
        'gender.in' => 'El género seleccionado no es válido.',
    ]);

    try {
        // Actualiza el paciente con los datos validados
        $patient->update([
            'names' => $validated['name'],
            'last_names' => $validated['last_names'],
            'ci' => $validated['ci'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? $patient->phone,
            'birthdate' => $validated['birthdate'] ?? $patient->birthdate,
            'gender' => $validated['gender'] ?? $patient->gender,
            'blood_type' => $validated['blood_type'] ?? $patient->blood_type,
            'allergies' => $validated['allergies'] ?? $patient->allergies,
            'emergency_contact' => $validated['emergency_contact'] ?? $patient->emergency_contact,
            'health_insurance_number' => $validated['health_insurance_number'] ?? $patient->health_insurance_number,
            'observations' => $validated['observations'] ?? $patient->observations,
            'address' => $validated['address'] ?? $patient->address,
        ]);

        // Redirige a la lista de pacientes con un mensaje de éxito
        return redirect()->route('admin.patients.index')
            ->with('message', 'Paciente actualizado correctamente.')
            ->with('icons', 'success');
    } catch (\Exception $e) {
        // Manejar errores
        return redirect()->route('admin.patients.edit', $patient->id)
            ->with('message', 'Hubo un problema al actualizar el paciente.')
            ->with('icons', 'error');
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();
        return redirect()->route('admin.patients.index')
        ->with('message', 'Paciente eliminado correctamente.')
        ->with('icons', 'success');
    }
}
