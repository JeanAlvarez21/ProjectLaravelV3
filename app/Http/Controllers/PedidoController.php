<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use App\Models\Producto;
use App\Models\Detalles_Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'El carrito está vacío.');
        }

        DB::beginTransaction();

        try {
            // Crear el pedido
            $pedido = new Pedidos();
            $pedido->id_usuario = Auth::id();
            $pedido->fecha_pedido = now();
            $pedido->direccion_pedido = $request->input('direccion_pedido', Auth::user()->direccion);
            $pedido->total = 0;
            $pedido->save();

            $total = 0;

            // Procesar cada item del carrito
            foreach ($cart as $id => $details) {
                $producto = Producto::findOrFail($id);

                // Verificar stock
                if ($producto->stock < $details['quantity']) {
                    throw new \Exception("Stock insuficiente para " . $producto->nombre);
                }

                // Crear detalle del pedido
                $detalle = new Detalles_Pedido();
                $detalle->pedido_id = $pedido->id_pedido;
                $detalle->producto_id = $id;
                $detalle->cantidad = $details['quantity'];
                $detalle->subtotal = $details['price'] * $details['quantity'];
                $detalle->save();

                // Actualizar stock
                $producto->stock -= $details['quantity'];
                $producto->save();

                $total += $details['price'] * $details['quantity'];
            }

            // Actualizar total del pedido
            $pedido->total = $total;
            $pedido->save();

            // Limpiar carrito
            session()->forget('cart');

            DB::commit();

            return redirect()->route('pedidos.show', $pedido->id_pedido)
                ->with('success', 'Pedido creado exitosamente.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('cart.view')
                ->with('error', 'Error al procesar el pedido: ' . $e->getMessage());
        }
    }

    public function show(Pedidos $pedido)
    {
        // Cargar las relaciones necesarias
        $pedido->load(['usuario', 'detalles.producto']);
        return view('pedidos.show', compact('pedido'));
    }

    public function index()
    {
        $pedidos = Pedidos::with(['usuario', 'detalles.producto'])
            ->orderBy('fecha_pedido', 'desc')
            ->paginate(10);
        return view('pedidos.index', compact('pedidos'));
    }
}