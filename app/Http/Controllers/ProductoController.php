<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::with('categoria');  // Mantén la relación con 'categoria'

        // Verificar si hay un término de búsqueda
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nombre_producto', 'like', '%' . $search . '%');  // Filtrar por nombre del producto
        }

        // Obtener los productos con el filtro de búsqueda aplicado
        $productos = $query->get();

        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre_producto' => 'required|string|max:100',
            'descripcion' => 'required|string|max:255',
            'unidad_medida' => 'required|string|max:50',
            'link_imagen' => 'required|string|max:255',
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'visible' => 'boolean',
        ]);

        Producto::create($validatedData);

        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre_producto' => 'required|string|max:100',
            'descripcion' => 'required|string|max:255',
            'unidad_medida' => 'required|string|max:50',
            'link_imagen' => 'required|string|max:255',
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'visible' => 'boolean',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($validatedData);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }


    
}