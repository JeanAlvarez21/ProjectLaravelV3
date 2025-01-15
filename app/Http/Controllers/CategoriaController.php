<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        // Obtiene todas las categorías
        $categorias = Categoria::all();

        // Retorna la vista con las categorías
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_categoria' => 'required|string|max:255',
        ]);

        Categoria::create([
            'nombre_categoria' => $request->nombre_categoria,
        ]);

        return redirect()->route('productos.index')->with('success', 'Categoría añadida exitosamente.');
    }
}