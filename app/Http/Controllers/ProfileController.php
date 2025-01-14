<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return view('perfil.PerfilUsuario');
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'nombres' => 'required|string|max:255|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'apellidos' => 'required|string|max:255|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id, 
            'telefono' => 'required|string|max:20|regex:/^\d+$/',
            'password' => 'nullable|string|min:8|confirmed',
        ], [
            'email.unique' => 'El correo electrónico ya está registrado.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'nombres.regex' => 'El campo nombres solo puede contener letras y espacios.',
            'apellidos.regex' => 'El campo apellidos solo puede contener letras y espacios.',
        ]);

        // Actualizar los datos del usuario
        $user->nombres = $validated['nombres'];
        $user->apellidos = $validated['apellidos'];
        $user->email = $validated['email'];
        $user->telefono = $validated['telefono'];

        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->back()->with('success', 'Perfil actualizado exitosamente');
    }

    public function updateAddress(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'nombres' => 'required|string|max:255|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'apellidos' => 'required|string|max:255|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20|regex:/^\d+$/',
        ]);

        $user->nombres = $validated['nombres'];
        $user->apellidos = $validated['apellidos'];
        $user->direccion = $validated['direccion'];
        $user->telefono = $validated['telefono'];

        $user->save();

        return redirect()->back()->with('success', 'Dirección actualizada exitosamente');
    }
}
