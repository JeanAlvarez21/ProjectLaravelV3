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
            'nombre' => 'required|string|max:255', // Nombre del producto (obligatorio y con longitud máxima)
            'descripcion' => 'required|string', // Descripción detallada (obligatoria)
            'id_categoria' => 'required|exists:categorias,id_categoria', // Validación estándar
            'nueva_categoria' => 'nullable|string|max:255|required_if:id_categoria,nueva', // Solo requerida si se selecciona "nueva"
            'descripcion_categoria' => 'nullable|string|required_if:id_categoria,nueva', // Solo requerida si se selecciona "nueva"
            'codigo_producto' => 'required|string|max:100|unique:productos,codigo_producto', // Código único del producto
            'precio' => 'required|numeric|min:0', // Precio del producto (debe ser un número positivo)
            'costo' => 'required|numeric|min:0', // Costo unitario (debe ser un número positivo)
            'stock' => 'required|integer|min:0', // Cantidad disponible (mínimo 0)
            'min_stock' => 'required|integer|min:0', // Stock mínimo permitido (mínimo 0)
            'visible' => 'required|boolean', // Producto visible (1 o 0)
            'imagen' => 'nullable|string|max:255', // URL de la imagen (opcional y longitud máxima)
            'nombre_sucursal' => 'required|string|max:100', // Nombre de la sucursal (obligatorio)
            'direccion_sucursal' => 'required|string|max:100', // Dirección de la sucursal (obligatorio)
        ]);
        

        // Manejar la categoría
        if ($request->id_categoria === 'nueva') {
            $categoria = Categoria::create([
                'nombre_categoria' => strtoupper(trim($request->nueva_categoria)),
                'descripcion_categoria' => $request->descripcion // Aquí se usa la nueva descripción
            ]);
            $id_categoria = $categoria->id_categoria; // Usar el ID de la categoría recién creada
        } else {
            $id_categoria = $request->id_categoria; // Si el usuario eligió una familia existente
        }

        // Manejar la imagen
        $rutaImagen = null;
        // En tu lógica para manejar la imagen
            if ($request->hasFile('imagen')) {
                $imagen = $request->file('imagen');
                $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
                $imagen->move(public_path('assets/productos'), $nombreImagen);
                $rutaImagen = 'assets/productos/' . $nombreImagen;
            } else {
                $rutaImagen = null; // Si no se sube imagen, puedes asignar null o mantener el valor actual
            }

        Producto::create([
            'nombre' => $request->nombre, // Nuevo nombre de columna
            'descripcion_categoria' => $request->descripcion,
            'id_categoria' => $id_categoria, // ID de la categoría
            'codigo_producto' => $request->codigo_producto, // Código único del producto
            'precio' => $request->precio, // Precio del producto
            'costo' => $request->costo, // Costo del producto
            'stock' => $request->stock, // Cantidad en inventario
            'min_stock' => $request->min_stock, // Stock mínimo permitido
            'visible' => $request->visible, // Visibilidad del producto (1 o 0)
            'imagen' => $rutaImagen, // Ruta de la imagen (asegúrate de manejarla antes)
            'nombre_sucursal' => $request->nombre_sucursal, // Nombre de la sucursal
            'direccion_sucursal' => $request->direccion_sucursal, // Dirección de la sucursal
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
            'nombre' => 'required|string|max:255', // Nombre del producto (obligatorio y con longitud máxima de 255 caracteres)
            'descripcion' => 'required|string', // Descripción detallada (obligatoria)
            'id_categoria' => 'required|exists:categorias,id_categoria', // Debe ser un ID válido en la tabla 'categorias'
            'codigo_producto' => 'required|string|max:100|unique:productos,codigo_producto', // Código único del producto
            'precio' => 'required|numeric|min:0', // Precio del producto (debe ser un número positivo)
            'costo' => 'required|numeric|min:0', // Costo unitario (debe ser un número positivo)
            'stock' => 'required|integer|min:0', // Cantidad disponible en inventario (mínimo 0)
            'min_stock' => 'required|integer|min:0', // Stock mínimo permitido (mínimo 0)
            'visible' => 'required|boolean', // Producto visible (1 o 0)
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Cambié la validación aquí
            'nombre_sucursal' => 'required|string|max:100', // Nombre de la sucursal (obligatorio)
            'direccion_sucursal' => 'required|string|max:100', // Dirección de la sucursal (obligatorio)
        ]);
        

        // Manejar la categoría
        if ($request->id_categoria === 'nueva') {
            $categoria = Categoria::create(
                ['nombre_categoria' => strtoupper(trim($request->nueva_categoria))],
                ['descripcion_categoria' => trim($request->descripcion_categoria)] // Asegurarse de recibir esta descripción
            );
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
            'nombre' => $request->nombre, // Nuevo nombre de columna
            'descripcion' => $request->descripcion, // Descripción del producto
            'id_categoria' => $request->id_categoria, // Relación con la tabla categorías
            'codigo_producto' => $request->codigo_producto, // Código único del producto (si se permite modificarlo)
            'precio' => $request->precio, // Precio del producto
            'costo' => $request->costo, // Costo del producto
            'stock' => $request->stock, // Cantidad en inventario
            'min_stock' => $request->min_stock, // Stock mínimo permitido
            'visible' => $request->visible, // Producto visible (1 o 0)
            'imagen' => $request->hasFile('imagen') ? $request->file('imagen')->store('productos', 'public') : $producto->imagen, // Subir nueva imagen o mantener la existente
            'nombre_sucursal' => $request->nombre_sucursal, // Nombre de la sucursal
            'direccion_sucursal' => $request->direccion_sucursal, // Dirección de la sucursal
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