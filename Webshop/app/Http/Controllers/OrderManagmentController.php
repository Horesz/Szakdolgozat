<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderStatusUpdated;
class OrderManagmentController extends Controller
{
    public function index(Request $request)
    {
        // Jogosultság ellenőrzése
        if (!Auth::check() || (!Auth::user()->isAdmin() && !Auth::user()->isMunkatars())) {
            abort(403, 'Nincs jogosultsága megtekinteni ezt az oldalt.');
        }

        $query = Order::query();

        // Szűrési opciók
        if ($request->filled('status')) {
            $query->where('order_status', $request->status);
        }

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Rendezés
        $query->orderBy(
            $request->input('sort_by', 'created_at'), 
            $request->input('sort_direction', 'desc')
        );

        $orders = $query->paginate(20);

        return view('layouts.admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Jogosultság ellenőrzése
        if (!Auth::check() || (!Auth::user()->isAdmin() && !Auth::user()->isMunkatars())) {
            abort(403, 'Nincs jogosultsága megtekinteni ezt az oldalt.');
        }

        return view('layouts.admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        // Jogosultság ellenőrzése
        if (!Auth::check() || (!Auth::user()->isAdmin() && !Auth::user()->isMunkatars())) {
            abort(403, 'Nincs jogosultsága módosítani a rendelés státuszát.');
        }

        $validated = $request->validate([
            'order_status' => 'required|in:pending,processing,shipped,delivered,completed,cancelled,refunded'
        ]);

        // Régi státusz mentése az e-mail értesítéshez
        $oldStatus = $order->order_status;
        $newStatus = $validated['order_status'];

        // Csak akkor küldjünk e-mailt, ha tényleg változott a státusz
        if ($oldStatus !== $newStatus) {
            $order->update([
                'order_status' => $newStatus
            ]);

            // E-mail küldése a rendelőnek
            try {
                Mail::to($order->email)->send(new OrderStatusUpdated($order, $oldStatus, $newStatus));
            } catch (\Exception $e) {
                \Log::error('Hiba a státusz frissítési e-mail küldésekor: ' . $e->getMessage());
            }

            return redirect()->route('admin.orders.show', $order)
                ->with('success', 'Rendelés státusza sikeresen módosítva és értesítő e-mail elküldve.');
        }

        return redirect()->route('admin.orders.show', $order)
            ->with('info', 'Rendelés státusza nem változott.');
    }

    public function updatePaymentStatus(Request $request, Order $order)
    {
        // Jogosultság ellenőrzése
        if (!Auth::check() || (!Auth::user()->isAdmin() && !Auth::user()->isMunkatars())) {
            abort(403, 'Nincs jogosultsága módosítani a fizetési státuszt.');
        }

        $validated = $request->validate([
            'payment_status' => 'required|in:pending,paid,failed,refunded'
        ]);

        // Régi státusz mentése az e-mail értesítéshez
        $oldStatus = $order->payment_status;
        $newStatus = $validated['payment_status'];

        // Csak akkor küldjünk e-mailt, ha tényleg változott a státusz
        if ($oldStatus !== $newStatus) {
            $order->update([
                'payment_status' => $newStatus
            ]);

            // E-mail küldése a rendelőnek fizetési státusz változásáról
            try {
                Mail::to($order->email)->send(new OrderStatusUpdated($order, $oldStatus, $newStatus, true));
            } catch (\Exception $e) {
                \Log::error('Hiba a fizetési státusz frissítési e-mail küldésekor: ' . $e->getMessage());
            }

            return redirect()->route('admin.orders.show', $order)
                ->with('success', 'Fizetési státusz sikeresen módosítva és értesítő e-mail elküldve.');
        }

        return redirect()->route('admin.orders.show', $order)
            ->with('info', 'Fizetési státusz nem változott.');
    }
}