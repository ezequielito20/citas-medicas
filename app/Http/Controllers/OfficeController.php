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
    public function show(Office $office)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Office $office)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOfficeRequest $request, Office $office)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Office $office)
    {
        //
    }
}
