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
            $quantity = max(1, intval($request->quantity ?? 1));
            $cart = session()->get('cart', []);

            if (strpos($id, 'proyecto_') === 0) {
                $proyectoId = substr($id, 9);
                $proyecto = Proyecto::findOrFail($proyectoId);
                $cart[$id] = [
                    "name" => $proyecto->nombre,
                    "quantity" => $quantity,
                    "price" => floatval($this->calculateProjectPrice($proyecto)),
                    "image" => "ruta_a_imagen_por_defecto.jpg",
                    "type" => "proyecto"
                ];
            } else {
                $product = Producto::findOrFail($id);
                $price = number_format((float) $product->precio, 2, '.', '');

                if (isset($cart[$id])) {
                    $cart[$id]['quantity'] = min($product->stock, $cart[$id]['quantity'] + $quantity);
                } else {
                    $cart[$id] = [
                        "name" => $product->nombre,
                        "quantity" => min($product->stock, $quantity),
                        "price" => (float) $price,
                        "image" => $product->link_imagen,
                        "stock" => $product->stock,
                        "type" => "producto"
                    ];
                }
            }

            session()->put('cart', $cart);

            $subtotal = $cart[$id]['price'] * $cart[$id]['quantity'];
            $total = $this->calculateTotal($cart);

            return response()->json([
                'success' => 'Ítem agregado al carrito exitosamente!',
                'cart' => $cart,
                'subtotal' => number_format($subtotal, 2, '.', ''),
                'total' => number_format($total, 2, '.', '')
            ]);
        } catch (\Exception $e) {
            \Log::error('Error en addToCart: ' . $e->getMessage());
            return response()->json(['error' => 'Ocurrió un error al procesar tu solicitud.'], 500);
        }
    }

    public function updateCart(Request $request)
    {
        try {
            if ($request->id && $request->quantity) {
                $cart = session()->get('cart', []);
                $id = $request->id;
                $quantity = max(1, intval($request->quantity));

                if (!isset($cart[$id])) {
                    return response()->json(['error' => 'Producto no encontrado en el carrito.'], 404);
                }

                if (strpos($id, 'proyecto_') === 0) {
                    $cart[$id]["quantity"] = $quantity;
                } else {
                    $product = Producto::findOrFail($id);
                    if ($quantity <= $product->stock) {
                        $cart[$id]["quantity"] = $quantity;
                    } else {
                        return response()->json([
                            'error' => 'No hay suficiente stock disponible.',
                            'available_stock' => $product->stock
                        ], 400);
                    }
                }

                session()->put('cart', $cart);

                $subtotal = $cart[$id]['price'] * $cart[$id]['quantity'];
                $total = $this->calculateTotal($cart);

                return response()->json([
                    'success' => 'Carrito actualizado exitosamente!',
                    'subtotal' => number_format($subtotal, 2),
                    'total' => number_format($total, 2)
                ]);
            }
            return response()->json(['error' => 'Datos inválidos'], 400);
        } catch (\Exception $e) {
            \Log::error('Error en updateCart: ' . $e->getMessage());
            return response()->json(['error' => 'Ocurrió un error al actualizar el carrito.'], 500);
        }
    }

    public function removeFromCart(Request $request)
    {
        try {
            if ($request->id) {
                $cart = session()->get('cart', []);
                if (isset($cart[$request->id])) {
                    unset($cart[$request->id]);
                    session()->put('cart', $cart);

                    return response()->json([
                        'success' => 'Ítem eliminado del carrito exitosamente!',
                        'total' => number_format($this->calculateTotal($cart), 2)
                    ]);
                }
            }
            return response()->json(['error' => 'Producto no encontrado'], 404);
        } catch (\Exception $e) {
            \Log::error('Error en removeFromCart: ' . $e->getMessage());
            return response()->json(['error' => 'Ocurrió un error al eliminar el producto.'], 500);
        }
    }

    public function viewCart()
    {
        $cart = session()->get('cart', []);
        $total = $this->calculateTotal($cart);
        return view('cart', compact('cart', 'total'));
    }

    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $price = number_format((float) $item['price'], 2, '.', '');
            $quantity = intval($item['quantity']);
            $total += (float) $price * $quantity;
        }
        return $total;
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

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'El carrito está vacío.');
        }

        $total = $this->calculateTotal($cart);

        return view('order_confirmation', compact('cart', 'total'));
    }
}