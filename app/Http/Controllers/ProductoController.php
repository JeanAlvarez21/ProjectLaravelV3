<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('categoria')->get();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    public function checkId(Request $request)
    {
        $producto = Producto::find($request->id_producto);
        return response()->json([
            'exists' => $producto ? true : false,
            'edit_url' => $producto ? route('productos.edit', $producto->id_producto) : null
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_producto' => 'required|unique:productos,id_producto',
            'nombre_producto' => 'required|string|max:100',
            'descripcion' => 'required|string|max:100',
            'cantidad' => 'required|integer|min:0',
            'unidad_medida' => 'required|string|max:50',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'id_categoria' => 'required',
            'visible' => 'required|in:1,2'
        ]);

        // Manejar la categoría
        if ($request->id_categoria === 'nueva') {
            $categoria = Categoria::create([
                'nombre_categoria' => strtoupper(trim($request->nueva_categoria))
            ]);
            $id_categoria = $categoria->id_categoria;
        } else {
            $id_categoria = $request->id_categoria;
        }

        // Manejar la imagen
        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('assets/productos'), $nombreImagen);
            $rutaImagen = 'assets/productos/' . $nombreImagen;
        }

        Producto::create([
            'id_producto' => $request->id_producto,
            'nombre_producto' => $request->nombre_producto,
            'descripcion' => $request->descripcion,
            'cantidad' => $request->cantidad,
            'unidad_medida' => $request->unidad_medida,
            'link_imagen' => $rutaImagen,
            'id_categoria' => $id_categoria,
            'visible' => $request->visible,
        ]);

        return redirect()->route('productos.index')
            ->with('success', 'Producto creado exitosamente.');
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre_producto' => 'required|string|max:100',
            'descripcion' => 'required|string|max:100',
            'cantidad' => 'required|integer|min:0',
            'unidad_medida' => 'required|string|max:50',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'id_categoria' => 'required',
            'visible' => 'required|in:1,2', // Validar que sea 1 (privado) o 2 (público
        ]);

        // Manejar la categoría
        if ($request->id_categoria === 'nueva') {
            $categoria = Categoria::create([
                'nombre_categoria' => strtoupper(trim($request->nueva_categoria))
            ]);
            $id_categoria = $categoria->id_categoria;
        } else {
            $id_categoria = $request->id_categoria;
        }

        // Manejar la imagen
        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($producto->link_imagen && file_exists(public_path($producto->link_imagen))) {
                unlink(public_path($producto->link_imagen));
            }

            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('assets/productos'), $nombreImagen);
            $rutaImagen = 'assets/productos/' . $nombreImagen;
        }

        $producto->update([
            'nombre_producto' => $request->nombre_producto,
            'descripcion' => $request->descripcion,
            'cantidad' => $request->cantidad,
            'unidad_medida' => $request->unidad_medida,
            'link_imagen' => $request->hasFile('link_imagen') ? $request->file('link_imagen')->store('productos', 'public') : $producto->link_imagen,
            'id_categoria' => $request->id_categoria,
            'visible' => $request->visible, // Guardar directamente el valor enviado
        ]);

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy(Producto $producto)
    {
        if ($producto->link_imagen && file_exists(public_path($producto->link_imagen))) {
            unlink(public_path($producto->link_imagen));
        }
        
        $producto->delete();
        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado exitosamente.');
    }
}