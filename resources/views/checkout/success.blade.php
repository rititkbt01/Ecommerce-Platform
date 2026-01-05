@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Success Message -->
    <div class="bg-green-100 border-2 border-green-500 rounded-lg p-8 text-center mb-8">
        <div class="text-6xl mb-4">✅</div>
        <h1 class="text-3xl font-bold text-green-700 mb-2">Order Placed Successfully!</h1>
        <p class="text-gray-700">Thank you for your order. We'll send you a confirmation email shortly.</p>
    </div>
    
    <!-- Order Details -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-xl font-bold mb-4">Order Details</h2>
        
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <p class="text-gray-600 text-sm">Order Number</p>
                <p class="font-bold">#{{ $order->id }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Order Date</p>
                <p class="font-bold">{{ $order->created_at->format('M d, Y') }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Status</p>
                <p class="font-bold text-yellow-600 uppercase">{{ $order->status }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Total</p>
                <p class="font-bold text-lg">${{ number_format($order->total, 2) }}</p>
            </div>
        </div>
        
        <!-- Shipping Info -->
        <div class="border-t pt-4">
            <h3 class="font-bold mb-2">Shipping Information</h3>
            <p class="text-gray-700">{{ $order->name }}</p>
            <p class="text-gray-700">{{ $order->email }}</p>
            <p class="text-gray-700">{{ $order->phone }}</p>
            <p class="text-gray-700">{{ $order->address }}</p>
        </div>
    </div>
    
    <!-- Order Items -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-xl font-bold mb-4">Order Items</h2>
        
        <div class="space-y-3">
            @foreach($order->orderItems as $item)
            <div class="flex justify-between items-center border-b pb-3">
                <div>
                    <p class="font-semibold">{{ $item->product->name }}</p>
                    <p class="text-sm text-gray-600">Quantity: {{ $item->quantity }}</p>
                </div>
                <p class="font-bold">${{ number_format($item->price * $item->quantity, 2) }}</p>
            </div>
            @endforeach
        </div>
    </div>
    
    <!-- Actions -->
    <div class="text-center">
        <a href="/" class="bg-blue-500 text-white px-8 py-3 rounded-lg hover:bg-blue-600 inline-block">
            Continue Shopping
        </a>
    </div>
</div>
@endsection