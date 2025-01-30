<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function viewCart()
    {
        $userId = auth()->id();
        $cart = Session::get("cart.$userId", []);
        $total = $this->calculateTotal($cart);
        return view('cart', compact('cart', 'total'));
    }

    public function addToCart(Request $request)
    {
        $userId = auth()->id();
        $cart = Session::get("cart.$userId", []);

        $id = $request->id;
        $type = $request->type ?? 'producto';
        $quantity = $request->quantity ?? 1;

        try {
            if ($type === 'proyecto') {
                $proyecto = Proyecto::findOrFail($id);
                $item = [
                    "name" => $proyecto->nombre,
                    "quantity" => $quantity,
                    "price" => $this->calculateProjectPrice($proyecto),
                    "image" => "ruta_a_imagen_por_defecto.jpg",
                    "type" => "proyecto"
                ];
                $cartKey = "proyecto_$id";
            } else {
                $producto = Producto::findOrFail($id);
                $item = [
                    "name" => $producto->nombre,
                    "quantity" => $quantity,
                    "price" => $producto->precio,
                    "image" => $producto->imagen,
                    "type" => "producto",
                    "stock" => $producto->stock
                ];
                $cartKey = $id;
            }

            if (isset($cart[$cartKey])) {
                $cart[$cartKey]['quantity'] += $quantity;
            } else {
                $cart[$cartKey] = $item;
            }

            Session::put("cart.$userId", $cart);
            Session::save();

            return response()->json(['success' => 'Producto agregado al carrito con éxito.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al agregar el producto al carrito: ' . $e->getMessage()], 500);
        }
    }

    public function checkout()
    {
        $userId = Auth::id();
        $cart = session()->get("cart.$userId", []);

        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'El carrito está vacío.');
        }

        $total = $this->calculateTotal($cart);

        return view('order_confirmation', compact('cart', 'total'));
    }

    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
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

            if ($productoVolume > 0) {
                $cantidadProductosNecesarios = ceil($corteVolume / $productoVolume);
            } else {
                $cantidadProductosNecesarios = 1; // Default to 1 if product volume is 0
            }

            $totalPrice += ($productoPrice * $cantidadProductosNecesarios) + $corte->precio_corte;
        }
        return $totalPrice;
    }
    public function removeFromCart(Request $request)
    {
        $userId = auth()->id();
        $cart = Session::get("cart.$userId", []);

        $id = $request->id;

        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put("cart.$userId", $cart);
            Session::save();

            $total = $this->calculateTotal($cart);

            return response()->json(['success' => 'Producto eliminado del carrito', 'total' => $total]);
        }

        return response()->json(['error' => 'Producto no encontrado en el carrito'], 404);
    }
    public function updateCart(Request $request)
    {
        $userId = auth()->id();
        $cart = Session::get("cart.$userId", []);

        $id = $request->id;
        $quantity = $request->quantity;

        // Verificar si el producto existe en el carrito
        if (isset($cart[$id])) {
            // Si el tipo es 'producto', verificar el stock disponible
            if ($cart[$id]['type'] === 'producto') {
                $producto = Producto::find($id);
                if ($producto && $quantity > $producto->stock) {
                    return response()->json([
                        'error' => 'La cantidad solicitada supera el stock disponible.',
                        'available_stock' => $producto->stock
                    ], 400);
                }
            }

            // Actualizar la cantidad en el carrito
            $cart[$id]['quantity'] = $quantity;

            // Guardar el carrito actualizado en la sesión
            Session::put("cart.$userId", $cart);
            Session::save();

            // Calcular el nuevo subtotal y el total del carrito
            $subtotal = $cart[$id]['price'] * $quantity;
            $total = $this->calculateTotal($cart);

            return response()->json([
                'success' => 'Cantidad actualizada correctamente.',
                'subtotal' => number_format($subtotal, 2),
                'total' => number_format($total, 2)
            ]);
        }

        return response()->json(['error' => 'Producto no encontrado en el carrito.'], 404);
    }
}

