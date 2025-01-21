<?php

namespace App\Http\Controllers;

use App\Models\Corte;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class CorteController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'proyecto_id' => 'required|exists:proyectos,id',
        'id_producto' => 'required|exists:productos,id', // Cambiado de producto_id a id_producto
        'cantidad' => 'required|integer|min:1',
        'medidas' => 'required|string|max:255',
        'tipo_borde' => 'required|string|max:255',
        'color_borde' => 'required|string|max:255',
        'descripcion_corte' => 'nullable|string|max:255',
        'precio_total' => 'required|numeric|min:0',
    ]);

    Corte::create($request->all());

    return back()->with('success', 'Corte agregado correctamente.');
}

}
