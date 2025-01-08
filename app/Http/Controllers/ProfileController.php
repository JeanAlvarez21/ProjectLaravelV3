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
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id, // Verificar duplicados
            'telefono' => 'required|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
        ], [
            'email.unique' => 'El correo electrónico ya está registrado.',
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
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
        ]);

        $user->nombres = $validated['nombres'];
        $user->apellidos = $validated['apellidos'];
        $user->direccion = $validated['direccion'];
        $user->telefono = $validated['telefono'];

        $user->save();

        return redirect()->back()->with('success', 'Dirección actualizada exitosamente');
    }
}
