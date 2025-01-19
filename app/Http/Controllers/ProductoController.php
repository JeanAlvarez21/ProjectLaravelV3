<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

 // Asegúrate de importar esta clase al inicio del archivo


class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search'); // Aquí obtienes el valor de la búsqueda

        $productos = Producto::when($search, function ($query, $search) {
            $query->where('id', $search)
                ->orWhere('nombre', 'like', '%' . $search . '%');
        })->paginate(10); // Puedes ajustar el número de elementos por página

        return view('productos.index', compact('productos', 'search'));
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
            'descripcion' => 'required|string|max:255', // Descripción detallada (obligatoria)
            'id_categoria' => 'required', // Validación estándar
            //'nueva_categoria' => 'nullable|string|max:255|required_if:id_categoria,nueva',  Solo requerida si se selecciona "nueva"
            //'descripcion_categoria' => 'nullable|string|required_if:id_categoria,nueva', // Solo requerida si se selecciona "nueva"
            'codigo_producto' => 'required|string|max:100|unique:productos,codigo_producto', // Código único del producto
            'precio' => 'required|numeric|min:0', // Precio del producto (debe ser un número positivo)
            'costo' => 'required|numeric|min:0', // Costo unitario (debe ser un número positivo)
            'stock' => 'required|integer|min:0', // Cantidad disponible (mínimo 0)
            'min_stock' => 'required|integer|min:0', // Stock mínimo permitido (mínimo 0)
            'visible' => 'required|boolean', // Producto visible (1 o 0)
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nombre_sucursal' => 'required|string|max:100', // Nombre de la sucursal (obligatorio)
            'direccion_sucursal' => 'required|string|max:100', // Dirección de la sucursal (obligatorio)
            ],
            ['codigo_producto.unique'=>'Ya existe un producto con este Código' ]);
    
        

        // Manejar la categoría
        if ($request->id_categoria === 'nueva') {
            $categoria = Categoria::create([
                'nombre_categoria' => ucfirst(strtolower($request->nueva_categoria)),
                'descripcion_categoria' => ucfirst(strtolower($request->descripcion_categoria)) // Aquí se usa la nueva descripción
            ]);
            $id_categoria = $categoria->id_categoria; // Usar el ID de la categoría recién creada
        } else {
            $id_categoria = $request->id_categoria; // Si el usuario eligió una familia existente
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
            'codigo_producto' => $request->codigo_producto, // Código único del producto
            'nombre' => $request->nombre, // Nuevo nombre de columna
            'descripcion' => $request->descripcion,
            'id_categoria' => $id_categoria, // ID de la categoría
            //'descripcion_categoria' => $request->descripcion,
            'precio' => $request->precio, // Precio del producto
            'costo' => $request->costo, // Costo del producto
            'stock' => $request->stock, // Cantidad en inventario
            'min_stock' => $request->min_stock, // Stock mínimo permitido
            'visible' => $request->visible, // Visibilidad del producto (1 o 0)
            'link_imagen' => $rutaImagen, // Ruta de la imagen (asegúrate de manejarla antes)
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
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255', // Nombre del producto
            'descripcion' => 'required|string|max:255', // Descripción detallada
            'id_categoria' => 'required', // Validar la categoría
            'codigo_producto' => [
                'required',
                'string',
                'max:100',
                Rule::unique('productos', 'codigo_producto')->ignore($producto->id), // Usa 'id' como clave primaria
            ],
            'precio' => 'required|numeric|min:0', // Precio
            'costo' => 'required|numeric|min:0', // Costo
            'stock' => 'required|integer|min:0', // Stock
            'min_stock' => 'required|integer|min:0', // Stock mínimo
            'visible' => 'required|boolean', // Visibilidad
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validar imagen
            'nombre_sucursal' => 'required|string|max:100', // Nombre de la sucursal
            'direccion_sucursal' => 'required|string|max:100', // Dirección de la sucursal
        ]);
    
        // Manejar la categoría
        if ($request->id_categoria === 'nueva') {
            $categoria = Categoria::create([
                'nombre_categoria' => ucfirst(strtolower($request->nueva_categoria)),
                'descripcion_categoria' => ucfirst(strtolower($request->descripcion_categoria)),
            ]);
            $id_categoria = $categoria->id_categoria;
        } else {
            $id_categoria = $request->id_categoria;
        }
    
        // Manejar la imagen
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior si existe
            if ($producto->link_imagen && file_exists(public_path($producto->link_imagen))) {
                unlink(public_path($producto->link_imagen));
            }
    
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('assets/productos'), $nombreImagen);
            $rutaImagen = 'assets/productos/' . $nombreImagen;
        } else {
            $rutaImagen = $producto->link_imagen; // Mantener la imagen existente
        }
    
        // Actualizar los datos del producto
        $producto->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'id_categoria' => $id_categoria,
            'codigo_producto' => $request->codigo_producto,
            'precio' => $request->precio,
            'costo' => $request->costo,
            'stock' => $request->stock,
            'min_stock' => $request->min_stock,
            'visible' => $request->visible,
            'link_imagen' => $rutaImagen,
            'nombre_sucursal' => $request->nombre_sucursal,
            'direccion_sucursal' => $request->direccion_sucursal,
        ]);
    
        // Redirigir con un mensaje de éxito
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