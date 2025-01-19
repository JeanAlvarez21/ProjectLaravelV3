<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function index()
    {
    $proyectos = Proyecto::with('producto')->get(); // Obtener todos los proyectos con sus productos asociados
    return view('proyectos.index', compact('proyectos')); // Retornar una vista con los datos
    }
    public function create()
    {
        $productos = Producto::all();
        return view('proyectos.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'ciudad' => 'required|string|max:100',
            'local' => 'required|string|max:100',
            'producto_id' => 'required|exists:productos,id_producto',
        ]);

        // Crear el proyecto
        $proyecto = Proyecto::create($validated);

        // Redirigir al formulario de creación de cortes, pasando el proyecto recién creado
        return redirect()->route('cortes.create', ['proyecto_id' => $proyecto->id])
            ->with('success', 'Proyecto creado con éxito. Ahora puedes añadir cortes.');
    }

    /**
     * Muestra un proyecto específico.
     */
    public function show($id)
    {
        $proyecto = Proyecto::with('cortes')->findOrFail($id);
        return response()->json($proyecto);
    }

    /**
     * Elimina un proyecto.
     */
    public function destroy($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->delete();
        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado con éxito.');
    }
}
