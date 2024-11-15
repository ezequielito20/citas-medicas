<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Secretary;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\StoreSecretaryRequest;
use App\Http\Requests\UpdateSecretaryRequest;

class SecretaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $secretaries = Secretary::with('user')->get();
        return view('admin.secretaries.index', compact('secretaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('admin.secretaries.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'last_names' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'ci' => 'required|string|max:20|unique:secretaries,ci',
            'phone' => 'nullable|string|max:20',
            'birthdate' => 'nullable|date',
            'address' => 'nullable|string|max:255',
        ], [
            'user_id.required' => 'El usuario es obligatorio.',
            'user_id.exists' => 'El usuario seleccionado no existe.',
        ]);

        try {
            // Crear la secretaria y asociarla al usuario seleccionado
            Secretary::create([
                'names' => $validated['name'],
                'last_names' => $validated['last_names'],
                'user_id' => $validated['user_id'],  // Asociar el usuario
                'ci' => $validated['ci'],
                'phone' => $validated['phone'] ?? null,
                'birthdate' => $validated['birthdate'] ?? null,
                'address' => $validated['address'] ?? null,
            ]);

            // Redirigir con mensaje de éxito
            return redirect()->route('admin.secretaries.index')
                ->with('message', 'Secretaria creada correctamente.')
                ->with('icons', 'success');
        } catch (\Exception $e) {
            // Si ocurre un error, redirigir con mensaje de error
            return redirect()->route('admin.secretaries.create')
                ->with('message', 'Hubo un problema al crear la secretaria.')
                ->with('icons', 'error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $secretary = Secretary::with('user')->findOrFail($id);
        return view('admin.secretaries.show', compact('secretary'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $secretary = Secretary::with('user')->findOrFail($id);

        $users = User::all();
        return view('admin.secretaries.edit', compact('secretary', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Encuentra la secretaria por ID o lanza una excepción si no se encuentra
        $secretary = Secretary::findOrFail($id);

        // Valida los datos de entrada
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'last_names' => 'required|string|max:255',
            'user_id' => [
                'required',
                'exists:users,id', // Verifica que el usuario exista
                Rule::unique('secretaries', 'user_id')->ignore($secretary->id), // Evita duplicados excepto el actual
            ],
            'ci' => [
                'required',
                'string',
                'max:20',
                Rule::unique('secretaries', 'ci')->ignore($secretary->id), // Permite que la cédula sea única excepto para la actual
            ],
            'phone' => 'nullable|string|max:20',
            'birthdate' => 'nullable|date',
            'address' => 'nullable|string|max:255',
        ], [
            'user_id.required' => 'El usuario es obligatorio.',
            'user_id.exists' => 'El usuario seleccionado no existe.',
            'user_id.unique' => 'El usuario ya está asociado a otra secretaria.',
            'ci.unique' => 'La cédula ya está asociada a otra secretaria.',
        ]);

        try {
            // Actualiza la secretaria con los datos validados
            $secretary->update([
                'names' => $validated['name'],
                'last_names' => $validated['last_names'],
                'user_id' => $validated['user_id'], // Actualiza el usuario asociado
                'ci' => $validated['ci'],
                'phone' => $validated['phone'] ?? $secretary->phone,
                'birthdate' => $validated['birthdate'] ?? $secretary->birthdate,
                'address' => $validated['address'] ?? $secretary->address,
            ]);

            // Redirige a la lista de secretarias con un mensaje de éxito
            return redirect()->route('admin.secretaries.index')
                ->with('message', 'Secretaria actualizada correctamente.')
                ->with('icons', 'success');
        } catch (\Exception $e) {
            // Si ocurre un error, redirige con mensaje de error
            return redirect()->route('admin.secretaries.edit', $secretary->id)
                ->with('message', 'Hubo un problema al actualizar la secretaria.')
                ->with('icons', 'error');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Secretary $secretary)
    {
        //
    }
}
