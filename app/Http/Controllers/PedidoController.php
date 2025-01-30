<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use App\Models\Producto;
use App\Models\Detalles_Pedido;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PedidoController extends Controller
{
    public function store(Request $request)
    {
        $userId = Auth::id();
        $cart = session()->get("cart.$userId", []);

        if (empty($cart)) {
            return redirect()->route('cart.checkout')->with('error', 'El carrito está vacío.');
        }

        DB::beginTransaction();

        try {
            // Crear el pedido
            $pedido = new Pedidos();
            $pedido->id_usuario = $userId;
            $pedido->fecha_pedido = now();
            $pedido->direccion_pedido = $request->input('direccion_pedido', Auth::user()->direccion);
            $pedido->total = 0; // Inicializamos el total
            $pedido->save();

            $total = 0;

            // Procesar cada item del carrito
            foreach ($cart as $id => $details) {
                $quantity = $details['quantity'] ?? 1;

                if (strpos($id, 'proyecto_') === 0) {
                    $proyectoId = substr($id, 9);
                    $proyecto = Proyecto::find($proyectoId);
                    if (!$proyecto) {
                        throw new \Exception("Proyecto no encontrado: ID {$proyectoId}");
                    }

                    $detalle = new Detalles_Pedido();
                    $detalle->pedido_id = $pedido->id_pedido;
                    $detalle->proyecto_id = $proyecto->id;
                    $detalle->cantidad = $quantity;
                    $detalle->precio = $details['price'];
                    $detalle->subtotal = $details['price'] * $quantity;
                    $detalle->save();
                } else {
                    $producto = Producto::find($id);
                    if (!$producto) {
                        throw new \Exception("Producto no encontrado: ID {$id}");
                    }

                    if ($producto->stock < $quantity) {
                        throw new \Exception("Stock insuficiente para '{$producto->nombre}'.");
                    }

                    $detalle = new Detalles_Pedido();
                    $detalle->pedido_id = $pedido->id_pedido;
                    $detalle->producto_id = $id;
                    $detalle->cantidad = $quantity;
                    $detalle->precio = $producto->precio;
                    $detalle->subtotal = $producto->precio * $quantity;
                    $detalle->save();

                    // Actualizar stock del producto
                    $producto->stock -= $quantity;
                    $producto->save();
                }

                $total += $detalle->subtotal;
            }

            // Actualizar el total del pedido
            $pedido->total = $total;
            $pedido->save();

            // Limpiar el carrito
            session()->forget("cart.$userId");

            DB::commit();

            return redirect()->route('pedidos.detalles', $pedido->id_pedido)
                ->with('success', 'Pedido creado exitosamente.');

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error al procesar el pedido: ' . $e->getMessage());
            return redirect()->route('cart.checkout')
                ->with('error', 'Error al procesar el pedido: ' . $e->getMessage())
                ->withInput();
        }
    }



    public function show($id)
    {
        try {
            $pedido = Pedidos::with(['usuario', 'detalles.producto', 'detalles.proyecto'])
                ->findOrFail($id);
            return view('pedidos.show', compact('pedido'));
        } catch (\Exception $e) {
            Log::error('Error al mostrar el pedido: ' . $e->getMessage());
            return redirect()->route('pedidos.index')
                ->with('error', 'No se pudo cargar el pedido solicitado.');
        }
    }

    public function index()
    {
        $pedidos = Pedidos::with('usuario')->get();
        return view('pedidos.index', compact('pedidos'));
    }

    public function detalles($id)
    {
        try {
            $pedido = Pedidos::with(['detalles.producto', 'detalles.proyecto'])
                ->where('id_usuario', Auth::id())
                ->findOrFail($id);

            return view('pedidos.detalles', compact('pedido'));
        } catch (\Exception $e) {
            Log::error('Error al cargar los detalles del pedido: ' . $e->getMessage());
            return back()->with('error', 'Error al cargar los detalles del pedido.');
        }
    }
}

