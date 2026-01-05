<?php

namespace App\Http\Controllers;

use App\Models\Order;

class UserOrderController extends Controller
{
    // List all orders of logged-in user
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    // Show single order details
    public function show(Order $order)
    {
        // SECURITY CHECK
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('orderItems.product');

        return view('orders.show', compact('order'));
    }
}
