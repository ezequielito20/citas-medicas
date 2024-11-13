<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        // Valida los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:5|max:20|confirmed',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de caracteres.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',
            
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            
            'password.required' => 'La contraseña es obligatoria.',
            'password.string' => 'La contraseña debe ser una cadena de caracteres.',
            'password.min' => 'La contraseña debe tener al menos 5 caracteres.',
            'password.max' => 'La contraseña no puede tener más de 20 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        

        try {
            // Crear el usuario
            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
            ]);
    
            // Redirigir con mensaje de éxito
            return redirect()->route('admin.users.index')
                ->with('message', 'Usuario creado correctamente.')
                ->with('icons', 'success');
        } catch (\Exception $e) {
            // Si ocurre un error, redirigir con mensaje de error
            return redirect()->route('admin.users.create')
            ->with('message', 'Hubo un problema al crear el usuario.')
            ->with('icons', 'error');
        }
    }
}
