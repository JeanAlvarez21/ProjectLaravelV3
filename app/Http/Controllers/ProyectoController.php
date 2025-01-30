<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Producto;
use App\Models\Corte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProyectoController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Session::has('cart')) {
                Session::put('cart', []);
            }
            return $next($request);
        });
    }

    private function validateProyecto(Request $request)
    {
        return $request->validate([
            'nombre' => 'required|string|max:255',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'largo' => 'required|numeric|min:0',
            'ancho' => 'required|numeric|min:0',
            'espesor' => 'required|numeric|min:0',
        ]);
    }

    private function createCorte(Request $request, Proyecto $proyecto)
    {
        $producto = Producto::findOrFail($request->producto_id);
        $precioCorte = 5.00; // Precio fijo por corte, ajustar según necesidades
        return Corte::create([
            'proyecto_id' => $proyecto->id,
            'producto_id' => $producto->id,
            'cantidad' => $request->cantidad,
            'largo' => $request->largo,
            'ancho' => $request->ancho,
            'espesor' => $request->espesor,
            'precio_corte' => $precioCorte,
        ]);
    }

    public function index()
    {
        $proyectos = Proyecto::where('user_id', auth()->id())->get();
        return view('proyectos.index', compact('proyectos'));
    }

    public function create()
    {
        $productos = Producto::all();
        return view('proyectos.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $this->validateProyecto($request);

        $proyecto = Proyecto::create([
            'nombre' => $request->nombre,
            'user_id' => auth()->id(),
        ]);

        $this->createCorte($request, $proyecto);

        return redirect()->route('proyectos.show', $proyecto)->with('success', 'Proyecto creado con éxito');
    }

    public function show(Proyecto $proyecto)
    {
        $proyecto->load('cortes.producto');
        return view('proyectos.show', compact('proyecto'));
    }

    public function addToCart(Proyecto $proyecto)
    {
        $userId = auth()->id();
        $cart = Session::get("cart.$userId", []);
        $proyectoId = 'proyecto_' . $proyecto->id;

        if (isset($cart[$proyectoId])) {
            $cart[$proyectoId]['quantity']++;
        } else {
            $price = $this->calculateProjectPrice($proyecto);
            $cart[$proyectoId] = [
                "name" => $proyecto->nombre,
                "quantity" => 1,
                "price" => $price,
                "image" => "ruta_a_imagen_por_defecto.jpg",
                "type" => "proyecto"
            ];
        }

        Session::put("cart.$userId", $cart);
        return redirect()->route('cart.view')->with('success', 'Proyecto agregado al carrito con éxito');
    }

    private function calculateProjectPrice(Proyecto $proyecto)
    {
        $totalPrice = 0;
        foreach ($proyecto->cortes as $corte) {
            $productoPrice = $corte->producto->precio;
            $corteVolume = ($corte->largo * $corte->ancho * $corte->espesor) / 1000000; // Convertir a metros cúbicos
            $productoVolume = ($corte->producto->largo * $corte->producto->ancho * $corte->producto->espesor) / 1000000;
            $cantidadProductosNecesarios = ($productoVolume > 0) ? ceil($corteVolume / $productoVolume) : 1; // Default to 1 if product volume is 0
            $totalPrice += ($productoPrice * $cantidadProductosNecesarios) + $corte->precio_corte;
        }
        return $totalPrice;
    }

    public function edit(Proyecto $proyecto)
    {
        $productos = Producto::all();
        return view('proyectos.edit', compact('proyecto', 'productos'));
    }

    public function update(Request $request, Proyecto $proyecto)
    {
        $this->validateProyecto($request);

        $proyecto->update([
            'nombre' => $request->nombre,
        ]);

        $corte = $proyecto->cortes->first(); // Asumiendo que cada proyecto tiene un solo corte
        $corte->update([
            'producto_id' => $request->producto_id,
            'cantidad' => $request->cantidad,
            'largo' => $request->largo,
            'ancho' => $request->ancho,
            'espesor' => $request->espesor,
        ]);

        return redirect()->route('proyectos.show', $proyecto)->with('success', 'Proyecto actualizado con éxito');
    }

    public function destroy(Proyecto $proyecto)
    {
        $proyecto->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado con éxito');
    }
}
