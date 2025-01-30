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

        return redirect()->back()->with('success', 'Producto agregado al carrito con éxito.');
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
}

