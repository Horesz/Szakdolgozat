<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Kosár tartalma oldal megjelenítése
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $cartItems = [];
        $subtotal = 0;
        
        // Kosár tételek részleteinek lekérése
        foreach ($cart as $id => $details) {
            $product = Product::find($id);
            
            if ($product) {
                $cartItems[$id] = $details;
                $cartItems[$id]['product'] = $product;
                $subtotal += $details['price'] * $details['quantity'];
            }
        }
        
        // Szállítási költség és egyéb változók számítása
        $shippingCost = $subtotal > 20000 ? 0 : 1500; // Ingyenes szállítás 20.000 Ft felett
        $total = $subtotal + $shippingCost;
        
        return view('layouts.admin.cart.index', compact('cartItems', 'subtotal', 'shippingCost', 'total'));
    }

    /**
     * Termék mennyiségének frissítése a kosárban
     */
    public function update(Request $request)
    {
        $id = $request->input('id');
        $quantity = $request->input('quantity');
        
        if ($id && $quantity) {
            $cart = session()->get('cart', []);
            
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = $quantity;
                session()->put('cart', $cart);
                
                // Kosár termékek számának frissítése
                $cartCount = array_sum(array_column($cart, 'quantity'));
                session()->put('cart_count', $cartCount);
                
                return response()->json([
                    'success' => true, 
                    'message' => 'Mennyiség sikeresen frissítve!',
                    'cartCount' => $cartCount,
                    'itemSubtotal' => number_format($cart[$id]['price'] * $quantity, 0, ',', ' ') . ' Ft'
                ]);
            }
        }
        
        return response()->json(['success' => false, 'message' => 'Frissítés sikertelen!']);
    }

    /**
     * Termék eltávolítása a kosárból
     */
    public function remove(Request $request)
    {
        $id = $request->input('id');
        
        if ($id) {
            $cart = session()->get('cart', []);
            
            if (isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
                
                // Kosár termékek számának frissítése
                $cartCount = array_sum(array_column($cart, 'quantity'));
                session()->put('cart_count', $cartCount);
                
                return response()->json([
                    'success' => true, 
                    'message' => 'Termék sikeresen eltávolítva!',
                    'cartCount' => $cartCount
                ]);
            }
        }
        
        return response()->json(['success' => false, 'message' => 'Eltávolítás sikertelen!']);
    }

    /**
     * Kosár teljes ürítése
     */
    public function clear()
    {
        session()->forget('cart');
        session()->forget('cart_count');
        
        return redirect()->route('layouts.admin.cart.index')->with('success', 'A kosár sikeresen kiürítve!');
    }

    /**
     * Megrendelés feldolgozása - átirányítás a pénztárhoz
     */
    public function checkout()
    {
        // Ellenőrizzük, hogy van-e termék a kosárban
        if (!session()->has('cart') || count(session()->get('cart')) == 0) {
            return redirect()->route('layouts.admincart.index')->with('error', 'A kosár üres!');
        }
        
        // Itt később átirányíthatunk a checkout oldalra
        return redirect()->route('layouts.admin.cart.index')->with('info', 'A pénztár funkció hamarosan elérhető lesz!');
    }
}