<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOfficeRequest;
use App\Http\Requests\UpdateOfficeRequest;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offices = Office::all();
        return view('admin.offices.index', compact('offices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.offices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'address' => 'required|string|max:200',
            'capacity' => 'required|string|max:20',
            'phone' => 'nullable|string|max:20',
            'specialization' => 'required|string|max:100',
            'status' => 'required|string|in:Activo,Inactivo',
        ], [
            // Mensajes personalizados
            'name.required' => 'El nombre es obligatorio.',
            'address.required' => 'La dirección es obligatoria.',
            'capacity.required' => 'La capacidad es obligatoria.',
            'specialization.required' => 'La especialidad es obligatoria.',
            'status.required' => 'El estado es obligatorio.',
            'status.in' => 'El estado seleccionado no es válido.',
        ]);

        try {
            // Crear el registro del consultorio
            Office::create([
                'name' => $validated['name'],
                'address' => $validated['address'],
                'capacity' => $validated['capacity'],
                'phone' => $validated['phone'] ?? null,
                'specialization' => $validated['specialization'],
                'status' => $validated['status'],
            ]);

            // Redirigir con mensaje de éxito
            return redirect()->route('admin.offices.index')
                ->with('message', 'Consultorio creado correctamente.')
                ->with('icons', 'success');
        } catch (\Exception $e) {
            // Manejar errores
            return redirect()->route('admin.offices.create')
                ->with('message', 'Hubo un problema al crear el consultorio.')
                ->with('icons', 'error');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $office = Office::findOrFail($id);
        return view('admin.offices.show', compact('office'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $office = Office::findOrFail($id);
        return view('admin.offices.edit', compact('office'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Encuentra la oficina por ID o lanza una excepción si no se encuentra
        $office = Office::findOrFail($id);

        // Validar los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'address' => 'required|string|max:200',
            'capacity' => 'required|string|max:20',
            'phone' => 'nullable|string|max:20',
            'specialization' => 'required|string|max:100',
            'status' => 'required|string|in:Activo,Inactivo',
        ], [
            // Mensajes personalizados
            'name.required' => 'El nombre del consultorio es obligatorio.',
            'address.required' => 'La dirección es obligatoria.',
            'capacity.required' => 'La capacidad es obligatoria.',
            'specialization.required' => 'La especialidad es obligatoria.',
            'status.required' => 'El estado es obligatorio.',
            'status.in' => 'El estado seleccionado no es válido.',
        ]);

        try {
            // Actualiza la oficina con los datos validados
            $office->update([
                'name' => $validated['name'],
                'address' => $validated['address'],
                'capacity' => $validated['capacity'],
                'phone' => $validated['phone'] ?? $office->phone,
                'specialization' => $validated['specialization'],
                'status' => $validated['status'],
            ]);

            // Redirige con un mensaje de éxito
            return redirect()->route('admin.offices.index')
                ->with('message', 'Consultorio actualizado correctamente.')
                ->with('icons', 'success');
        } catch (\Exception $e) {
            // Manejar errores
            return redirect()->route('admin.offices.edit', $office->id)
                ->with('message', 'Hubo un problema al actualizar el consultorio.')
                ->with('icons', 'error');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $office = Office::findOrFail($id)->delete();    
        return redirect()->route('admin.offices.index')
        ->with('message', 'Consultorio eliminado correctamente.')
        ->with('icons', 'success');

    }
}
