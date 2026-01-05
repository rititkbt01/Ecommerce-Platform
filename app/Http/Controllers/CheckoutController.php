<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class CheckoutController extends Controller
{
    // Show checkout form
    public function index()
    {
        $cart = session()->get('cart', []);
        
        // If cart is empty, redirect back
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }
        
        $total = $this->calculateTotal($cart);
        
        return view('checkout.index', compact('cart', 'total'));
    }

    // Process the order
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        
        // Validate cart
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }
        
        // Validate form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string',
            'phone' => 'required|string',
        ]);
        
        $total = $this->calculateTotal($cart);
        
        // Create the order
        $order = Order::create([
            'user_id' => auth()->id(), // null if guest
            'total' => $total,
            'status' => 'pending',
            'name' => $validated['name'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
        ]);
        
        // Create order items
        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
            
            // Update product stock
            $product = Product::find($id);
            if ($product) {
                $product->stock -= $item['quantity'];
                $product->save();
            }
        }
        
        // Clear cart
        session()->forget('cart');
        
        // Redirect to success page
        return redirect()->route('checkout.success', $order->id);
    }

    // Show order success page
    public function success($orderId)
    {
        $order = Order::with('orderItems.product')->findOrFail($orderId);
        
        return view('checkout.success', compact('order'));
    }

    // Calculate total
    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}