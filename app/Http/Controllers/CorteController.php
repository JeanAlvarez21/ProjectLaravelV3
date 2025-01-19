<?php

namespace App\Http\Controllers;

use App\Models\Corte;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class CorteController extends Controller
{
    public function create(Request $request)
    {
        $proyecto = Proyecto::with('producto')->findOrFail($request->proyecto_id);

        return view('cortes.create', compact('proyecto'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'proyecto_id' => 'required|exists:proyectos,id',
            'producto_id' => 'required|exists:productos,id_producto',
            'cantidad' => 'required|integer|min:1',
            'medidas' => 'required|string|max:255',
            'tipo_borde' => 'required|string|max:255',
            'color_borde' => 'required|string|max:255',
            'descripcion_corte' => 'nullable|string',
            'precio_total' => 'required|numeric|min:0',
        ]);

        Corte::create($validated);

        return redirect()->route('proyectos.index')
            ->with('success', 'Corte añadido correctamente.');
    }

    /**
     * Muestra un corte específico.
     */
    public function show($id)
    {
        $corte = Corte::with('producto', 'proyecto')->findOrFail($id);
        return response()->json($corte);
    }

    /**
     * Elimina un corte.
     */
    public function destroy($id)
    {
        $corte = Corte::findOrFail($id);
        $corte->delete();
        return response()->json(['success' => true, 'message' => 'Corte eliminado.']);
    }
}
