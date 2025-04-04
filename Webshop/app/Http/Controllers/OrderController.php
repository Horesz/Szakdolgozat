<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation;

class OrderController extends Controller
{
    /**
     * Checkout oldal megjelenítése.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout()
    {
        // Ellenőrizzük, hogy van-e termék a kosárban
        if (!Session::has('cart') || empty(Session::get('cart'))) {
            return redirect()->route('cart.index')->with('error', 'A kosár üres, kérjük először adj hozzá termékeket.');
        }

        // Kosár adatok
        $cartItems = Session::get('cart');
        $subtotal = $this->calculateSubtotal($cartItems);
        
        // Alapértelmezett szállítási költség (a checkout oldalon a felhasználó ezt módosíthatja)
        $shippingCost = 1490;
        
        // Végösszeg számítása
        $total = $subtotal + $shippingCost;

        return view('checkout', compact('cartItems', 'subtotal', 'shippingCost', 'total'));
    }

    /**
     * Rendelés tárolása.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validálás
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'address_zip' => 'required|string|max:10',
            'address_city' => 'required|string|max:255',
            'address_street' => 'required|string|max:255',
            'address_additional' => 'nullable|string|max:255',
            'shipping_method' => 'required|in:courier,pickup_point,store',
            'payment_method' => 'required|in:card,transfer,cod',
            'order_notes' => 'nullable|string',
            'terms_accepted' => 'required|accepted',
            'coupon_code' => 'nullable|string|max:50',
            'save_address' => 'nullable|boolean',
        ]);

        // Ellenőrizzük, hogy van-e termék a kosárban
        if (!Session::has('cart') || empty(Session::get('cart'))) {
            return redirect()->route('cart.index')->with('error', 'A kosár üres, kérjük először adj hozzá termékeket.');
        }

        // Kosár adatok
        $cartItems = Session::get('cart');
        $subtotal = $this->calculateSubtotal($cartItems);
        
        // Szállítási költség számítása
        $shippingCost = $this->calculateShippingCost($request->shipping_method);
        
        // Kedvezmény számítása (egyszerűsített, valós környezetben kupon ellenőrzéssel)
        $discount = 0;
        
        // Végösszeg számítása
        $total = $subtotal + $shippingCost - $discount;

        try {
            DB::beginTransaction();
            
            // Rendelés létrehozása
            $order = new Order([
                'user_id' => Auth::id(),
                'order_number' => Order::generateOrderNumber(),
                'firstname' => $validated['firstname'],
                'lastname' => $validated['lastname'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address_zip' => $validated['address_zip'],
                'address_city' => $validated['address_city'],
                'address_street' => $validated['address_street'],
                'address_additional' => $validated['address_additional'],
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'discount' => $discount,
                'total' => $total,
                'shipping_method' => $validated['shipping_method'],
                'payment_method' => $validated['payment_method'],
                'payment_status' => 'pending',
                'order_status' => 'pending',
                'order_notes' => $validated['order_notes'],
                'coupon_code' => $validated['coupon_code'],
            ]);
            
            $order->save();
            
            // Rendelési tételek mentése
            foreach ($cartItems as $id => $item) {
                $product = Product::find($id);
                
                // Ellenőrizzük, hogy a termék létezik-e és van-e elegendő készleten
                if (!$product) {
                    throw new \Exception("A termék nem található (ID: $id)");
                }
                
                if ($product->stock_quantity < $item['quantity']) {
                    throw new \Exception("Nincs elegendő készleten a termékből: " . $product->name);
                }
                
                // Rendelési tétel létrehozása
                $orderItem = new OrderItem([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);
                
                $orderItem->save();
                
                // Készlet csökkentése
                $product->stock_quantity -= $item['quantity'];
                $product->save();
            }
            
            // Ha a felhasználó kérte, mentsük el a szállítási címet
            if (isset($validated['save_address']) && $validated['save_address']) {
                $user = Auth::user();
                $user->update([
                    'phone' => $validated['phone'],
                    'address_zip' => $validated['address_zip'],
                    'address_city' => $validated['address_city'],
                    'address_street' => $validated['address_street'],
                    'address_additional' => $validated['address_additional'],
                ]);
            }
            
            // Fizetési mód kezelése
            if ($validated['payment_method'] == 'card') {
                // Online fizetés esetén átirányítás a fizetési oldalra
                // Valós implementációban itt integrálnánk pl. a SimplePay fizetési kaput
                $paymentUrl = route('orders.payment', $order->id);
                
                DB::commit();
                
                // Kosár törlése
                Session::forget('cart');
                
                return redirect()->to($paymentUrl);
            } else {
                // Egyéb fizetési módok (utánvét, átutalás) esetén közvetlen befejezés
                
                // Email küldése a rendelés visszaigazolásáról
                Mail::to($order->email)->send(new OrderConfirmation($order));
                
                DB::commit();
                
                // Kosár törlése
                Session::forget('cart');
                
                return redirect()->route('orders.thankyou', $order->id)->with('success', 'Köszönjük a rendelést! A visszaigazolást elküldtük e-mailben.');
            }
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Hiba történt a rendelés feldolgozásakor: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Fizetési oldal megjelenítése.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function payment($id)
    {
        $order = Order::findOrFail($id);
        
        // Ellenőrizzük, hogy a rendelés a bejelentkezett felhasználóhoz tartozik-e
        if ($order->user_id != Auth::id()) {
            abort(403, 'Nincs jogosultságod ehhez a rendeléshez.');
        }
        
        // Ellenőrizzük, hogy a rendelés még fizetésre vár-e
        if ($order->payment_status != 'pending') {
            return redirect()->route('orders.show', $order->id)->with('info', 'Ez a rendelés már ki van fizetve.');
        }
        
        // Egyszerűsített fizetési oldal 
        // Valós környezetben itt integrálnánk a valódi fizetési szolgáltatót
        return view('orders.payment', compact('order'));
    }

    /**
     * Fizetés feldolgozása (szimuláció).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function processPayment(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        // Szimulált fizetési feldolgozás
        // Valós környezetben itt feldolgoznánk a fizetési szolgáltató válaszát
        
        $order->payment_status = 'paid';
        $order->order_status = 'processing';
        $order->save();
        
        // Email küldése a sikeres fizetésről
        Mail::to($order->email)->send(new OrderConfirmation($order));
        
        return redirect()->route('orders.thankyou', $order->id)->with('success', 'A fizetés sikeres volt! A rendelésed feldolgozás alatt áll.');
    }

    /**
     * Köszönő oldal megjelenítése.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function thankyou($id)
    {
        $order = Order::with('items')->findOrFail($id);
        
        // Ellenőrizzük, hogy a rendelés a bejelentkezett felhasználóhoz tartozik-e
        if ($order->user_id != Auth::id()) {
            abort(403, 'Nincs jogosultságod ehhez a rendeléshez.');
        }
        
        return view('orders.thankyou', compact('order'));
    }

    /**
     * Felhasználó rendeléseinek listázása.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('orders.index', compact('orders'));
    }

    /**
     * Rendelés részleteinek megjelenítése.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with('items')->findOrFail($id);
        
        // Ellenőrizzük, hogy a rendelés a bejelentkezett felhasználóhoz tartozik-e
        if ($order->user_id != Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Nincs jogosultságod ehhez a rendeléshez.');
        }
        
        return view('orders.show', compact('order'));
    }

    /**
     * Rendelés lemondása.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel($id)
    {
        $order = Order::findOrFail($id);
        
        // Ellenőrizzük, hogy a rendelés a bejelentkezett felhasználóhoz tartozik-e
        if ($order->user_id != Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Nincs jogosultságod ehhez a rendeléshez.');
        }
        
        // Ellenőrizzük, hogy a rendelés lemondható-e
        if (!$order->canBeCancelled()) {
            return redirect()->back()->with('error', 'Ez a rendelés már nem mondható le.');
        }
        
        try {
            DB::beginTransaction();
            
            // Rendelés státuszának módosítása
            $order->order_status = 'cancelled';
            $order->save();
            
            // Készlet visszaállítása
            foreach ($order->items as $item) {
                if ($item->product) {
                    $item->product->stock_quantity += $item->quantity;
                    $item->product->save();
                }
            }
            
            DB::commit();
            
            return redirect()->back()->with('success', 'A rendelést sikeresen lemondtad.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Hiba történt a rendelés lemondásakor: ' . $e->getMessage());
        }
    }

    /**
     * Részösszeg számítása.
     *
     * @param  array  $cartItems
     * @return float
     */
    private function calculateSubtotal($cartItems)
    {
        $subtotal = 0;
        
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        
        return $subtotal;
    }

    /**
     * Szállítási költség számítása a választott mód alapján.
     *
     * @param  string  $shippingMethod
     * @return float
     */
    private function calculateShippingCost($shippingMethod)
    {
        switch ($shippingMethod) {
            case 'courier':
                return 1490;
            case 'pickup_point':
                return 990;
            case 'store':
                return 0;
            default:
                return 1490;
        }
    }
}