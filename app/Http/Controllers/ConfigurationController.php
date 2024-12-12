<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuration;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreConfigurationRequest;
use App\Http\Requests\UpdateConfigurationRequest;


class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $configurations = Configuration::all();
        return view('admin.configurations.index', compact('configurations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.configurations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:configurations,email',
            'file' => 'nullable|max:2048', // Máx 2MB para archivos de imagen
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'address.required' => 'La dirección es obligatoria.',
            'email.required' => 'El correo es obligatorio.',
            'email.unique' => 'El correo ya está registrado.',
            'file.max' => 'El logo no debe superar los 2MB.',
        ]);

        try {
            // Manejar la carga del logo si está presente
            $logoPath = null;
            if ($request->hasFile('file')) {
                $logoPath = $request->file('file')->store('files', 'public');
            }

            // Crear la configuración con los datos validados
            Configuration::create([
                'name' => $validated['name'],
                'address' => $validated['address'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'logo' => $logoPath ?? '', // Ruta del logo o vacío si no se cargó
            ]);

            // Redirigir con mensaje de éxito
            return redirect()->route('admin.configurations.index')
                ->with('message', 'Configuración creada correctamente.')
                ->with('icons', 'success');
        } catch (\Exception $e) {
            // Manejar errores y redirigir con mensaje de error
            Log::error('Error al crear configuración: ' . $e->getMessage());

            return redirect()->route('admin.configurations.create')
                ->with('message', 'Hubo un problema al crear la configuración: ' . $e->getMessage())
                ->with('icons', 'error');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $configuration = Configuration::findOrFail($id);
        return view('admin.configurations.show', compact('configuration'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $configuration = Configuration::findOrFail($id);
        return view('admin.configurations.edit', compact('configuration'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Encuentra la configuración por ID o lanza una excepción si no se encuentra
        $configuration = Configuration::findOrFail($id);

        // Validar los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => [
                'required',
                'email',
                Rule::unique('configurations', 'email')->ignore($configuration->id),
            ],
            'file' => 'nullable|image|max:2048', // Asegurarse de que sea una imagen de máximo 2MB
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'address.required' => 'La dirección es obligatoria.',
            'email.required' => 'El correo es obligatorio.',
            'email.unique' => 'El correo ya está registrado.',
            'file.image' => 'El logo debe ser un archivo de imagen válido.',
            'file.max' => 'El logo no debe superar los 2MB.',
        ]);

        try {
            // Manejar la carga del logo si está presente
            if ($request->hasFile('file')) {
                // Eliminar el logo anterior si existe
                if ($configuration->logo && Storage::disk('public')->exists($configuration->logo)) {
                    Storage::disk('public')->delete($configuration->logo);
                }

                // Guardar el nuevo logo
                $logoPath = $request->file('file')->store('files', 'public');
            } else {
                // Mantener el logo actual si no se carga uno nuevo
                $logoPath = $configuration->logo;
            }

            // Actualizar la configuración con los datos validados
            $configuration->update([
                'name' => $validated['name'],
                'address' => $validated['address'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'logo' => $logoPath, // Ruta del logo actualizado o el existente
            ]);

            // Redirigir con mensaje de éxito
            return redirect()->route('admin.configurations.index')
                ->with('message', 'Configuración actualizada correctamente.')
                ->with('icons', 'success');
        } catch (\Exception $e) {
            // Manejar errores y redirigir con mensaje de error
            Log::error('Error al actualizar configuración: ' . $e->getMessage());

            return redirect()->route('admin.configurations.edit', $configuration->id)
                ->with('message', 'Hubo un problema al actualizar la configuración: ' . $e->getMessage())
                ->with('icons', 'error');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $configuration = Configuration::findOrFail($id);
        if ($configuration->logo && Storage::disk('public')->exists($configuration->logo)) {
            Storage::disk('public')->delete($configuration->logo);
        }
        $configuration->delete();
        return redirect()->route('admin.configurations.index')
        ->with('message', 'Configuración eliminada correctamente.')
        ->with('icons', 'success');
    }
}
