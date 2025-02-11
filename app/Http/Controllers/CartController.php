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
        try {
            $userId = auth()->id();
            $cart = Session::get("cart.$userId", []);
            $id = $request->id;
            $type = $request->type ?? 'producto';
            $quantity = $request->quantity ?? 1;
            $item = $this->createCartItem($id, $type, $quantity);
            $cartKey = $item['type'] === 'proyecto' ? "proyecto_$id" : $id;

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

    private function createCartItem($id, $type, $quantity)
    {
        if ($type === 'proyecto') {
            $proyecto = Proyecto::findOrFail($id);
            return [
                "name" => $proyecto->nombre,
                "quantity" => $quantity,
                "price" => $this->calculateProjectPrice($proyecto),
                "image" => "ruta_a_imagen_por_defecto.jpg",
                "type" => "proyecto"
            ];
        } else {
            $producto = Producto::findOrFail($id);
            return [
                "name" => $producto->nombre,
                "quantity" => $quantity,
                "price" => $producto->precio,
                "image" => $producto->link_imagen,
                "type" => "producto",
                "stock" => $producto->stock
            ];
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
        return array_reduce($cart, fn($total, $item) => $total + ($item['price'] * $item['quantity']), 0);
    }

    private function calculateProjectPrice(Proyecto $proyecto)
    {
        $totalPrice = 0;
        foreach ($proyecto->cortes as $corte) {
            $productoPrice = $corte->producto->precio;
            $corteVolume = $this->calculateVolume($corte->largo, $corte->ancho, $corte->espesor);
            $productoVolume = $this->calculateVolume($corte->producto->largo, $corte->producto->ancho, $corte->producto->espesor);
            $cantidadProductosNecesarios = $productoVolume > 0 ? ceil($corteVolume / $productoVolume) : 1;
            $totalPrice += ($productoPrice * $cantidadProductosNecesarios) + $corte->precio_corte;
        }
        return $totalPrice;
    }

    private function calculateVolume($largo, $ancho, $espesor)
    {
        return ($largo * $ancho * $espesor) / 1000000; // Convertir a metros cúbicos
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

        if (isset($cart[$id])) {
            if ($cart[$id]['type'] === 'producto') {
                $producto = Producto::find($id);
                if ($producto && $quantity > $producto->stock) {
                    return response()->json([
                        'error' => 'La cantidad solicitada supera el stock disponible.',
                        'available_stock' => $producto->stock
                    ], 400);
                }
            }

            $cart[$id]['quantity'] = $quantity;
            Session::put("cart.$userId", $cart);
            Session::save();

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
