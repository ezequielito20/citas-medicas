<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));

    }

    public function update(Request $request, $id)
    {
        // Encuentra el usuario por ID o lanza una excepción si no se encuentra
        $user = User::findOrFail($id);
    
        // Valida los datos de entrada
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id), // Ignora el correo del usuario actual
            ],
            'password' => 'nullable|string|min:5|max:20|confirmed', // Cambiado a nullable para permitir que no se actualice la contraseña
        ]);
    
        // Si se proporciona una nueva contraseña, actualiza el campo de contraseña
        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']); // Asegúrate de encriptar la contraseña
        } else {
            unset($validated['password']); // Elimina la contraseña del array si no se proporciona
        }
    
        // Actualiza el usuario con los datos validados
        $user->update($validated);
    
        // Redirige a la lista de usuarios con un mensaje de éxito
        return redirect()->route('admin.users.index')
            ->with('message', 'Usuario actualizado correctamente.')
            ->with('icons', 'success');
    }
}
