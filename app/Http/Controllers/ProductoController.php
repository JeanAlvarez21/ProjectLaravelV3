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
        $query = Producto::query();
        $search = trim($request->input('search'));

        // Aplicar filtros si existen
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('codigo_producto', $search)
                    ->orWhere('nombre', 'like', '%' . $search . '%');
            });
        }

        if ($request->has('categoria')) {
            $query->where('id_categoria', $request->categoria);
        }

        // Filtro de stock bajo
        if ($request->has('stock_status') && $request->stock_status === 'low') {
            $query->whereRaw('stock <= min_stock');
        }

        // Aplicar orden
        if ($request->has('orden')) {
            switch ($request->orden) {
                case 'nombre_asc':
                    $query->orderBy('nombre', 'asc');
                    break;
                case 'nombre_desc':
                    $query->orderBy('nombre', 'desc');
                    break;
                case 'precio_asc':
                    $query->orderBy('precio', 'asc');
                    break;
                case 'precio_desc':
                    $query->orderBy('precio', 'desc');
                    break;
            }
        }

        $productos = $query->paginate(10);
        $categorias = Categoria::all();

        // Calcular el estado de stock para cada producto
        $productos->each(function ($producto) {
            $producto->lowStock = $producto->isLowStock();
        });

        return view('productos.index', compact('productos', 'categorias', 'search'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'largo' => 'required|integer|min:1',
            'ancho' => 'required|integer|min:1',
            'grosor' => 'required|integer|min:1',
            'descripcion_opcional' => 'nullable|string|max:255',
            'id_categoria' => 'required',
            'codigo_producto' => 'required|string|max:100|unique:productos,codigo_producto',
            'precio' => 'required|numeric|min:0',
            'costo' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'visible' => 'required|boolean',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nombre_sucursal' => 'required|string|max:100',
            'direccion_sucursal' => 'required|string|max:100',
        ], [
            'codigo_producto.unique' => 'Ya existe un producto con este Código'
        ]);

        // Construir la descripción combinada
        $dimensiones = "{$request->largo}mm X {$request->ancho}mm X {$request->grosor}mm";
        $descripcionCompleta = $request->descripcion_opcional
            ? "{$dimensiones}\n{$request->descripcion_opcional}"
            : $dimensiones;

        // Manejo de categorías
        if ($request->id_categoria === 'nueva') {
            $categoria = Categoria::create([
                'nombre_categoria' => ucfirst(strtolower($request->nueva_categoria)),
                'descripcion_categoria' => ucfirst(strtolower($request->descripcion_categoria))
            ]);
            $id_categoria = $categoria->id_categoria;
        } else {
            $id_categoria = $request->id_categoria;
        }

        // Manejo de la imagen
        $rutaImagen = null;

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('assets/productos'), $nombreImagen);
            $rutaImagen = 'assets/productos/' . $nombreImagen;
        }

        // Crear el producto
        Producto::create([
            'codigo_producto' => $request->codigo_producto,
            'nombre' => $request->nombre,
            'descripcion' => $descripcionCompleta,
            'id_categoria' => $id_categoria,
            'precio' => $request->precio,
            'costo' => $request->costo,
            'stock' => $request->stock,
            'min_stock' => $request->min_stock,
            'visible' => $request->visible,
            'link_imagen' => $rutaImagen,
            'nombre_sucursal' => $request->nombre_sucursal,
            'direccion_sucursal' => $request->direccion_sucursal,
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

    public function showForClients()
    {
        $productos = Producto::with('categoria')->where('visible', 1)->get(); // Solo productos visibles para clientes
        return view('productos.clientes', compact('productos'));
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
    public function search(Request $request)
    {
        $query = Producto::query()->with('categoria');

        // Búsqueda por término
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('codigo_producto', 'like', "%{$search}%")
                    ->orWhere('nombre', 'like', "%{$search}%");
            });
        }

        // Filtro por categoría
        if ($categoria = $request->input('categoria')) {
            $query->where('id_categoria', $categoria);
        }

        // Filtro por estado de stock
        if ($stockStatus = $request->input('stock_status')) {
            switch ($stockStatus) {
                case 'low':
                    $query->whereRaw('stock <= min_stock AND stock > 0');
                    break;
                case 'out':
                    $query->where('stock', '<=', 0);
                    break;
            }
        }

        // Ordenar por nombre por defecto
        $query->orderBy('nombre');

        $productos = $query->get();

        return response()->json($productos);
    }
}