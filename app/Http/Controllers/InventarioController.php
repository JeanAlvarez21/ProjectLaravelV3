<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Producto;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function index(Request $request)
    {
        $query = Inventario::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('producto', function ($q) use ($search) {
                $q->where('nombre_producto', 'like', '%' . $search . '%');
            });
        }

        $inventarioItems = $query->get();
        return view('inventario.index', compact('inventarioItems'));
    }
    public function edit($id_inventario)
    {
        $inventario = Inventario::findOrFail($id_inventario);
        $productos = Producto::all();

        return view('inventario.edit', compact('inventario', 'productos'));
    }

    public function create()
    {
        // Obtén todos los productos para mostrarlos en el formulario
        $productos = Producto::all();

        // Retorna la vista para crear un nuevo ítem de inventario
        return view('inventario.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_producto' => 'required|exists:productos,id_producto',
            'cantidad_disponible' => 'required|integer|min:0',
            'precio_unitario' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string|max:255',
            'nombre_sucursal' => 'required|string|max:100',
            'direccion_sucursal' => 'required|string|max:255',
        ]);


        Inventario::create($validatedData);

        return redirect()->route('inventario.index')
            ->with('success', 'Item de inventario creado exitosamente.');

    }

    public function destroy($id_inventario)
    {
        $inventario = Inventario::findOrFail($id_inventario);
        $inventario->delete();

        return redirect()->route('inventario.index')
            ->with('success', 'Item de inventario eliminado exitosamente.');
    }

    public function update(Request $request, $id_inventario)
    {
        // Validación de los datos
        $validatedData = $request->validate([
            'id_producto' => 'required|exists:productos,id_producto',
            'cantidad_disponible' => 'required|integer|min:0',
            'precio_unitario' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string|max:255',
            'nombre_sucursal' => 'required|string|max:100',
            'direccion_sucursal' => 'required|string|max:255',
        ]);

        // Encontrar el item de inventario por su ID
        $inventario = Inventario::findOrFail($id_inventario);

        // Actualizar el item de inventario
        $inventario->update($validatedData);

        // Redirigir con un mensaje de éxito
        return redirect()->route('inventario.index')->with('success', 'Item de inventario actualizado exitosamente.');
    }


}