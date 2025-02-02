<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carpintero;
use Illuminate\Support\Facades\Auth;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CarpinteroController extends Controller
{
    public function index()
    {
        $carpinteros = Carpintero::all();
        return view('carpinteros.index', compact('carpinteros'));
    }

    public function manage()
    {
        if (!Auth::check() || !(Auth::user()->rol == 1 || Auth::user()->rol == 2)) {
            return redirect('/')->with('error', 'No tienes permiso para acceder a esta página.');
        }

        $carpinteros = Carpintero::all();
        return view('carpinteros.manage', compact('carpinteros'));
    }

    public function store(Request $request)
    {
        if (!Auth::check() || !(Auth::user()->rol == 1 || Auth::user()->rol == 2)) {
            return redirect('/')->with('error', 'No tienes permiso para realizar esta acción.');
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'especialidad' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'foto_perfil' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'descripcion' => 'nullable|string',
            'disponibilidad' => 'required|boolean',
            'ubicacion' => 'nullable|string|max:100',
        ]);

        $imageUrl = null;

        if ($request->hasFile('foto_perfil')) {
            $uploadedImage = Cloudinary::upload($request->file('foto_perfil')->getRealPath())->getSecurePath();
            $imageUrl = $uploadedImage;
        }

        Carpintero::create([
            'nombre' => $validated['nombre'],
            'especialidad' => $validated['especialidad'],
            'telefono' => $validated['telefono'],
            'email' => $validated['email'],
            'ubicacion' => $validated['ubicacion'],
            'foto_perfil' => $imageUrl,
            'descripcion' => $validated['descripcion'],
            'disponibilidad' => $validated['disponibilidad'],
        ]);

        return redirect()->route('carpinteros.manage')->with('success', 'Carpintero creado exitosamente.');
    }

    public function edit($id)
    {
        $carpintero = Carpintero::findOrFail($id);
        return view('carpinteros.edit', compact('carpintero'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'especialidad' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'foto_perfil' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'descripcion' => 'nullable|string',
            'disponibilidad' => 'required|boolean',
            'ubicacion' => 'nullable|string|max:100',
        ]);

        $carpintero = Carpintero::findOrFail($id);
        $imageUrl = $carpintero->foto_perfil;

        if ($request->hasFile('foto_perfil')) {
            // Eliminar imagen anterior de Cloudinary si existe
            if ($carpintero->foto_perfil) {
                $publicId = pathinfo($carpintero->foto_perfil, PATHINFO_FILENAME);
                Cloudinary::destroy($publicId);
            }

            // Subir nueva imagen
            $uploadedImage = Cloudinary::upload($request->file('foto_perfil')->getRealPath())->getSecurePath();
            $imageUrl = $uploadedImage;
        }

        $carpintero->update([
            'nombre' => $validated['nombre'],
            'especialidad' => $validated['especialidad'],
            'telefono' => $validated['telefono'],
            'email' => $validated['email'],
            'ubicacion' => $validated['ubicacion'],
            'foto_perfil' => $imageUrl,
            'descripcion' => $validated['descripcion'],
            'disponibilidad' => $validated['disponibilidad'],
        ]);

        return redirect()->route('carpinteros.manage')->with('success', 'Carpintero actualizado con éxito.');
    }

    public function destroy($id)
    {
        $carpintero = Carpintero::findOrFail($id);

        // Eliminar imagen de Cloudinary si existe
        if ($carpintero->foto_perfil) {
            $publicId = pathinfo($carpintero->foto_perfil, PATHINFO_FILENAME);
            Cloudinary::destroy($publicId);
        }

        $carpintero->delete();

        return redirect()->route('carpinteros.manage')->with('success', 'Carpintero eliminado con éxito.');
    }
}
