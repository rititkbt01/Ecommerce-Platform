<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // Show user's order history
    public function index()
    {
        // Get orders for logged-in user with pagination
        $orders = Order::where('user_id', auth()->id())
                      ->with('orderItems')
                      ->latest()
                      ->paginate(10);
        
        return view('orders.index', compact('orders'));
    }

    // Show single order details
    public function show(Order $order)
    {
        // Make sure user can only see their own orders
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }
        
        $order->load('orderItems.product');
        
        return view('orders.show', compact('order'));
    }
}