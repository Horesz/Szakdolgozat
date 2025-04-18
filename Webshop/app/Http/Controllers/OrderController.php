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
use Illuminate\Support\Str;

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
        
        // Kedvezmény (kupon, hűségpont stb.)
        $discount = 0;
        $loyaltyDiscount = 0;
        $availableLoyaltyPoints = 0;
        
        // Ha be van jelentkezve, akkor nézzük a hűségpontjait
        if (Auth::check()) {
            $user = Auth::user();
            $availableLoyaltyPoints = $user->loyalty_points ?? 0;
            
            // Születésnapos felhasználóknak extra pont/kedvezmény
            if (method_exists($user, 'hasBirthdayToday') && $user->hasBirthdayToday()) {
                session()->flash('birthday', 'Boldog születésnapot! Ma 500 extra pontot kapsz a rendelésedre!');
            }
        }
        
        // Végösszeg számítása
        $total = $subtotal + $shippingCost - $discount - $loyaltyDiscount;

        return view('checkout', compact(
            'cartItems', 
            'subtotal', 
            'shippingCost', 
            'discount',
            'loyaltyDiscount',
            'availableLoyaltyPoints',
            'total'
        ));
    }

    /**
     * Rendelés tárolása.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Alapvető validáció mindenkinek
        $rules = [
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
        ];

        // Ha be van jelentkezve, további validáció
        if (Auth::check()) {
            $rules['save_address'] = 'nullable|boolean';
            $rules['use_loyalty_points'] = 'nullable|boolean';
            $rules['loyalty_points_amount'] = 'nullable|integer|min:10';
        }

        $validated = $request->validate($rules);

        // Ellenőrizzük, hogy van-e termék a kosárban
        if (!Session::has('cart') || empty(Session::get('cart'))) {
            return redirect()->route('cart.index')->with('error', 'A kosár üres, kérjük először adj hozzá termékeket.');
        }

        // Kosár adatok
        $cartItems = Session::get('cart');
        $subtotal = $this->calculateSubtotal($cartItems);
        
        // Szállítási költség számítása
        $shippingCost = $this->calculateShippingCost($request->shipping_method);
        
        // Kedvezmény számítása és hűségpont kezelés
        $discount = 0;
        $loyaltyPointsUsed = 0;
        $loyaltyPointsEarned = 0;
        $isGuest = !Auth::check();
        
        // Ha bejelentkezett felhasználó
        if (!$isGuest) {
            $user = Auth::user();
            
            // Hűségpontok felhasználása, ha kérte
            if ($request->has('use_loyalty_points') && $request->use_loyalty_points) {
                $requestedPoints = (int) $request->loyalty_points_amount;
                
                if ($requestedPoints > 0 && $user->loyalty_points >= $requestedPoints) {
                    // 10 pont = 100 Ft kedvezmény
                    $pointsToUse = floor($requestedPoints / 10) * 10; // Kerekítés az alsó 10-re
                    $loyaltyDiscount = $pointsToUse / 10 * 100;
                    
                    // Maximum a rendelés 30%-a
                    $maxDiscount = $subtotal * 0.3;
                    if ($loyaltyDiscount > $maxDiscount) {
                        $loyaltyDiscount = $maxDiscount;
                        $pointsToUse = floor($maxDiscount / 10) * 10;
                    }
                    
                    $loyaltyPointsUsed = $pointsToUse;
                    $discount += $loyaltyDiscount;
                }
            }
            
            // Új pontok számítása (alapesetben minden 1000 Ft után 1 pont)
            $loyaltyPointsEarned = floor($subtotal / 1000);
            
            // Születésnapi bónusz
            if (method_exists($user, 'hasBirthdayToday') && $user->hasBirthdayToday()) {
                $loyaltyPointsEarned += 500; // Születésnapi bónusz
            }
            
            // Extra pont lojális ügyfeleknek
            if (property_exists($user, 'loyalty_points') && $user->loyalty_points >= 1000) { // Arany vagy platina tag
                $loyaltyPointsEarned = ceil($loyaltyPointsEarned * 1.2); // 20% extra pont
            }
        }
        
        // Végösszeg számítása
        $total = $subtotal + $shippingCost - $discount;
        if ($total < 0) $total = 0; // Biztosítjuk, hogy ne legyen negatív

        try {
            DB::beginTransaction();
            
            // Rendelés létrehozása
            $orderData = [
                'order_number' => Order::generateOrderNumber(),
                'firstname' => $validated['firstname'],
                'lastname' => $validated['lastname'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address_zip' => $validated['address_zip'],
                'address_city' => $validated['address_city'],
                'address_street' => $validated['address_street'],
                'address_additional' => $validated['address_additional'] ?? null,
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'discount' => $discount,
                'loyalty_points_used' => $loyaltyPointsUsed,
                'loyalty_points_earned' => $loyaltyPointsEarned,
                'total' => $total,
                'shipping_method' => $validated['shipping_method'],
                'payment_method' => $validated['payment_method'],
                'payment_status' => 'pending',
                'order_status' => 'pending',
                'order_notes' => $validated['order_notes'] ?? null,
                'coupon_code' => $validated['coupon_code'] ?? null,
                'is_guest' => $isGuest,
                'guest_token' => $isGuest ? Str::random(32) : null
            ];
            
            // Ha be van jelentkezve, akkor hozzáadjuk a user_id-t
            if (!$isGuest) {
                $orderData['user_id'] = Auth::id();
            }
            
            $order = new Order($orderData);
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
            
            // Ha bejelentkezett felhasználó
            if (!$isGuest) {
                $user = Auth::user();
                
                // Ha kérte a cím mentését
                if (isset($validated['save_address']) && $validated['save_address'] && $user) {
                    $user->update([
                        'phone' => $validated['phone'],
                        'address_zip' => $validated['address_zip'],
                        'address_city' => $validated['address_city'], 
                        'address_street' => $validated['address_street'],
                        'address_additional' => $validated['address_additional'] ?? null,
                    ]);
                }
                
                // Hűségpontok kezelése
                if ($loyaltyPointsUsed > 0 && method_exists($user, 'useLoyaltyPoints')) {
                    $user->useLoyaltyPoints($loyaltyPointsUsed);
                }
                
                if ($loyaltyPointsEarned > 0 && method_exists($user, 'addLoyaltyPoints')) {
                    $user->addLoyaltyPoints($loyaltyPointsEarned);
                }
            } else {
                // Vendég rendelések esetén mentsük el a vendég tokent a sessionbe
                Session::put('guest_order_' . $order->id, $order->guest_token);
            }
            
            // Fizetési mód kezelése
            if ($validated['payment_method'] == 'card') {
                // Online fizetés esetén átirányítás a fizetési oldalra
                $paymentUrl = route('orders.payment', $order->id);
                
                DB::commit();
                
                // Kosár törlése
                Session::forget('cart');
                Session::forget('cart_count');
                
                return redirect()->to($paymentUrl);
            } else {
                // Egyéb fizetési módok esetén közvetlen befejezés
                
                // Email küldése
                try {
                    Mail::to($order->email)->send(new OrderConfirmation($order));
                } catch (\Exception $e) {
                    // Email küldési hiba esetén csak naplózzuk, de ne szakítsuk meg a folyamatot
                    \Log::error('Hiba a rendelés visszaigazoló e-mail küldésekor: ' . $e->getMessage());
                }
                
                DB::commit();
                
                // Kosár törlése
                Session::forget('cart');
                Session::forget('cart_count');
                
                return redirect()->route('cart.thankyou', $order->id)->with('success', 'Köszönjük a rendelést! A visszaigazolást elküldtük e-mailben.');
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
        
        // Ellenőrizzük a jogosultságot
        if (!$this->canAccessOrder($order)) {
            abort(403, 'Nincs jogosultságod ehhez a rendeléshez.');
        }
        
        // Ellenőrizzük, hogy a rendelés még fizetésre vár-e
        if ($order->payment_status != 'pending') {
            return redirect()->route('orders.show', $order->id)->with('info', 'Ez a rendelés már ki van fizetve.');
        }
        
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
        
        // Ellenőrizzük a jogosultságot
        if (!$this->canAccessOrder($order)) {
            abort(403, 'Nincs jogosultságod ehhez a rendeléshez.');
        }
        
        // Szimulált fizetési feldolgozás
        $order->payment_status = 'paid';
        $order->order_status = 'processing';
        $order->save();
        
        // Email küldése a sikeres fizetésről
        try {
            Mail::to($order->email)->send(new OrderConfirmation($order));
        } catch (\Exception $e) {
            \Log::error('Hiba a fizetés visszaigazoló e-mail küldésekor: ' . $e->getMessage());
        }
        
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
        
        // Ellenőrizzük a jogosultságot - Email cím alapú ellenőrzés vendégeknek is
        if (!$this->canAccessOrder($order)) {
            abort(403, 'Nincs jogosultságod ehhez a rendeléshez.');
        }
        
        // Itt továbbítjuk a rendelés tételeit a nézetnek
        $orderItems = $order->items;
        
        return view('orders.thankyou', compact('order', 'orderItems'));
    }

    /**
     * Felhasználó rendeléseinek listázása.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Csak bejelentkezett felhasználók esetén
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'A rendelések megtekintéséhez be kell jelentkezned.');
        }
        
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
        
        // Ellenőrizzük a jogosultságot
        if (!$this->canAccessOrder($order)) {
            abort(403, 'Nincs jogosultságod ehhez a rendeléshez.');
        }
        
        // Itt is továbbítjuk a rendelés tételeit a nézetnek
        $orderItems = $order->items;
        
        return view('orders.show', compact('order', 'orderItems'));
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
        
        // Ellenőrizzük a jogosultságot
        if (!$this->canAccessOrder($order)) {
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
            
            // Ha hűségpontokat használt, azokat visszaadjuk
            if (!$order->is_guest && $order->loyalty_points_used > 0 && $order->user && method_exists($order->user, 'addLoyaltyPoints')) {
                $order->user->addLoyaltyPoints($order->loyalty_points_used);
            }
            
            // Ha új hűségpontokat kapott, azokat levonjuk
            if (!$order->is_guest && $order->loyalty_points_earned > 0 && $order->user && method_exists($order->user, 'useLoyaltyPoints')) {
                $order->user->useLoyaltyPoints($order->loyalty_points_earned);
            }
            
            DB::commit();
            
            return redirect()->back()->with('success', 'A rendelést sikeresen lemondtad.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Hiba történt a rendelés lemondásakor: ' . $e->getMessage());
        }
    }

    /**
     * Vendég rendelés követése (rendelés nyomon követési oldal).
     *
     * @return \Illuminate\Http\Response
     */
    public function trackOrder(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'order_number' => 'required|string',
        ]);
        
        $order = Order::where('email', $validated['email'])
                     ->where('order_number', $validated['order_number'])
                     ->first();
        
        if (!$order) {
            return redirect()->back()->with('error', 'A megadott rendelés nem található.');
        }
        
        return redirect()->route('orders.show', $order->id)->with([
            'email' => $validated['email'],
            'order_number' => $validated['order_number']
        ]);
    }

    /**
     * Ellenőrzi, hogy a felhasználónak van-e jogosultsága a rendeléshez.
     * Vendégek esetén email cím alapján, bejelentkezett felhasználók esetén user_id alapján.
     *
     * @param  \App\Models\Order  $order
     * @return boolean
     */
    private function canAccessOrder(Order $order)
    {
        // Adminoknak mindig van jogosultsága
        if (Auth::check() && method_exists(Auth::user(), 'isAdmin') && Auth::user()->isAdmin()) {
            return true;
        }
        
        // Bejelentkezett felhasználók esetén
        if (Auth::check()) {
            return $order->user_id == Auth::id();
        }
        
        // Vendégek esetén
        return Session::has('guest_order_' . $order->id) || 
               (request()->has('email') && request()->has('order_number') && 
                $order->email == request()->email && $order->order_number == request()->order_number);
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