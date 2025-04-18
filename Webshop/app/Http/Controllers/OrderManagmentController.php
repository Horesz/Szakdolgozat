<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderManagementController extends Controller
{
    public function index(Request $request)
    {
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

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'order_status' => 'required|in:pending,processing,shipped,delivered,completed,cancelled,refunded'
        ]);

        $order->update([
            'order_status' => $validated['order_status']
        ]);

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Rendelés státusza sikeresen módosítva.');
    }

    public function updatePaymentStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'payment_status' => 'required|in:pending,paid,failed,refunded'
        ]);

        $order->update([
            'payment_status' => $validated['payment_status']
        ]);

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Fizetési státusz sikeresen módosítva.');
    }

    public function export(Request $request)
    {
        // Exportálás CSV-be
        // Használhatsz package-et mint Maatwebsite\Excel
    }
}