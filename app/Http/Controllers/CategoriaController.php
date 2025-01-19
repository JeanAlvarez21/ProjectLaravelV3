<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(Request $request)
{
    // Obtener el término de búsqueda del formulario
    $search = $request->input('search');

    // Consultar categorías, filtrando por ID o nombre si se proporciona un término de búsqueda
    $categorias = Categoria::when($search, function ($query, $search) {
        $query->where('id_categoria', $search)
            ->orWhere('nombre_categoria', 'like', '%' . $search . '%');
    })->get();

    // Retornar la vista con los datos filtrados
    return view('categorias.index', compact('categorias', 'search'));
}

    public function create()
    {
        return view('categorias.create');
    }

    public function edit($id)
    {
        // Busca la categoría por su ID
        $categoria = Categoria::findOrFail($id);
    
        // Retorna la vista con la categoría específica
        return view('categorias.edit', compact('categoria'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_categoria' => 'required|string|max:255',
            'descripcion_categoria' => 'required|string|max:255'
        ]);

        Categoria::create([
            'nombre_categoria' => $request->nombre_categoria,
            'descripcion_categoria' => $request->descripcion_categoria,
        ]);

        return redirect()->route('categorias.index')->with('success', 'Familia añadida exitosamente.');
    }

    public function update(Request $request, Categoria $categoria)
{
    $request->validate([
        'nombre_categoria' => 'required|string|max:255',
        'descripcion_categoria' => 'required|string|max:255'
    ]);

    $categoria->update([
        'nombre_categoria' => $request->nombre_categoria,
        'descripcion_categoria' => $request->descripcion_categoria,
    ]);

    return redirect()->route('categorias.index')->with('success', 'Familia actualizada exitosamente.');
}

public function destroy(Request $request, $id)
{
    // Busca la categoría
    $categoria = Categoria::findOrFail($id);

    // Verifica si tiene productos asociados
    $productosAsociados = $categoria->productos()->count();

    if ($productosAsociados > 0 && !$request->confirmar_eliminacion) {
        // Redirige a la vista de edición con un mensaje de advertencia
        return redirect()->route('categorias.edit', $id)
            ->with('warning', 'La categoría tiene productos asociados. Si la eliminas, los productos también serán eliminados. Confirma para continuar.');
    }

    // Elimina los productos asociados
    $categoria->productos()->delete();

    // Elimina la categoría
    $categoria->delete();

    return redirect()->route('categorias.index')->with('success', 'Categoría y productos asociados eliminados exitosamente.');
}

}