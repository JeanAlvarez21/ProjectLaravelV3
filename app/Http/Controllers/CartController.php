<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $product = Producto::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->quantity;
        } else {
            $cart[$id] = [
                "name" => $product->nombre,
                "quantity" => $request->quantity,
                "price" => $product->costo,
                "image" => $product->imagen,
                "stock" => $product->stock
            ];
        }

        session()->put('cart', $cart);

        if ($request->ajax()) {
            return response()->json(['success' => 'Producto agregado al carrito exitosamente!']);
        }

        return redirect()->back()->with('success', 'Producto agregado al carrito exitosamente!');
    }

    public function updateCart(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $product = Producto::findOrFail($request->id);
            
            if($request->quantity <= $product->stock) {
                $cart[$request->id]["quantity"] = $request->quantity;
                session()->put('cart', $cart);
                
                if ($request->ajax()) {
                    return response()->json(['success' => 'Carrito actualizado exitosamente!']);
                }
                
                return redirect()->back()->with('success', 'Carrito actualizado exitosamente!');
            } else {
                if ($request->ajax()) {
                    return response()->json(['error' => 'No hay suficiente stock disponible.'], 400);
                }
                
                return redirect()->back()->with('error', 'No hay suficiente stock disponible.');
            }
        }
    }

    public function removeFromCart(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            
            if ($request->ajax()) {
                return response()->json(['success' => 'Producto eliminado del carrito exitosamente!']);
            }
            
            return redirect()->back()->with('success', 'Producto eliminado del carrito exitosamente!');
        }
    }

    public function viewCart()
    {
        return view('cart');
    }

    public function purchase(Request $request)
    {
        $cart = session()->get('cart', []);
        
        foreach ($cart as $id => $details) {
            $product = Producto::find($id);
            if ($product) {
                $newStock = $product->stock - $details['quantity'];
                if ($newStock >= 0) {
                    $product->stock = $newStock;
                    $product->save();
                } else {
                    return redirect()->back()->with('error', 'No hay suficiente stock para ' . $product->nombre);
                }
            }
        }

        // Clear the cart after successful purchase
        session()->forget('cart');

        return redirect()->route('cart.view')->with('success', '¡Compra realizada con éxito!');
    }
}

