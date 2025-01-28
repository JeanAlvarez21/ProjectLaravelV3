<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Proyecto;
use App\Models\Corte;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        try {
            $id = $request->id;
            $quantity = $request->quantity ?? 1;
            $cart = session()->get('cart', []);
            if (strpos($id, 'proyecto_') === 0) {
                $proyectoId = substr($id, 9);
                $proyecto = Proyecto::findOrFail($proyectoId);
                $cart[$id] = [
                    "name" => $proyecto->nombre,
                    "quantity" => $quantity,
                    "price" => $this->calculateProjectPrice($proyecto),
                    "image" => "ruta_a_imagen_por_defecto.jpg",
                    "type" => "proyecto"
                ];
            } else {
                $product = Producto::findOrFail($id);
                if (isset($cart[$id])) {
                    $cart[$id]['quantity'] += $quantity;
                } else {
                    $cart[$id] = [
                        "name" => $product->nombre,
                        "quantity" => $quantity,
                        "price" => $product->precio,
                        "image" => $product->link_imagen,
                        "stock" => $product->stock,
                        "type" => "producto"
                    ];
                }
            }

            session()->put('cart', $cart);

            return response()->json(['success' => 'Ítem agregado al carrito exitosamente!']);
        } catch (\Exception $e) {
            \Log::error('Error en addToCart: ' . $e->getMessage());
            return response()->json(['error' => 'Ocurrió un error al procesar tu solicitud.'], 500);
        }
    }

    public function updateCart(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $id = $request->id;

            if (strpos($id, 'proyecto_') === 0) {
                $cart[$id]["quantity"] = $request->quantity;
            } else {
                $product = Producto::findOrFail($id);
                if ($request->quantity <= $product->stock) {
                    $cart[$id]["quantity"] = $request->quantity;
                } else {
                    if ($request->ajax()) {
                        return response()->json(['error' => 'No hay suficiente stock disponible.'], 400);
                    }
                    return redirect()->back()->with('error', 'No hay suficiente stock disponible.');
                }
            }

            session()->put('cart', $cart);

            if ($request->ajax()) {
                return response()->json(['success' => 'Carrito actualizado exitosamente!']);
            }

            return redirect()->back()->with('success', 'Carrito actualizado exitosamente!');
        }
    }

    public function removeFromCart(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }

            if ($request->ajax()) {
                return response()->json(['success' => 'Ítem eliminado del carrito exitosamente!']);
            }

            return redirect()->back()->with('success', 'Ítem eliminado del carrito exitosamente!');
        }
    }

    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'El carrito está vacío.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('order_confirmation', compact('cart', 'total'));
    }

    private function calculateProjectPrice(Proyecto $proyecto)
    {
        $totalPrice = 0;
        foreach ($proyecto->cortes as $corte) {
            $productoPrice = $corte->producto->precio;
            $corteVolume = ($corte->largo * $corte->ancho * $corte->espesor) / 1000000; // Convertir a metros cúbicos
            $productoVolume = ($corte->producto->largo * $corte->producto->ancho * $corte->producto->espesor) / 1000000;
            $cantidadProductosNecesarios = ceil($corteVolume / $productoVolume);

            $totalPrice += ($productoPrice * $cantidadProductosNecesarios) + $corte->precio_corte;
        }
        return $totalPrice;
    }
}