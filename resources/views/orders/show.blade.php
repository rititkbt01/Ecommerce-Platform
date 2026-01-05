@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Back Button -->
    <a href="{{ route('orders.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">
        ← Back to Orders
    </a>
    
    <h1 class="text-3xl font-bold mb-8">Order #{{ $order->id }}</h1>
    
    <!-- Order Info -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <div>
                <p class="text-gray-600 text-sm">Order Date</p>
                <p class="font-bold">{{ $order->created_at->format('M d, Y') }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Order Status</p>
                <p class="font-bold">
                    <span class="inline-block px-3 py-1 rounded-full text-sm
                        @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                        @elseif($order->status === 'completed') bg-green-100 text-green-800
                        @else bg-red-100 text-red-800
                        @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Total Amount</p>
                <p class="font-bold text-xl text-blue-600">${{ number_format($order->total, 2) }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Items</p>
                <p class="font-bold">{{ $order->orderItems->count() }}</p>
            </div>
        </div>
        
        <!-- Shipping Information -->
        <div class="border-t pt-4">
            <h3 class="font-bold mb-2">Shipping Information</h3>
            <p class="text-gray-700">{{ $order->name }}</p>
            <p class="text-gray-700">{{ $order->email }}</p>
            <p class="text-gray-700">{{ $order->phone }}</p>
            <p class="text-gray-700">{{ $order->address }}</p>
        </div>
    </div>
    
    <!-- Order Items -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-4">Order Items</h2>
        
        <div class="space-y-4">
            @foreach($order->orderItems as $item)
            <div class="flex items-center justify-between border-b pb-4 last:border-b-0">
                <div class="flex items-center space-x-4 flex-1">
                    <div class="bg-gray-200 w-16 h-16 rounded flex items-center justify-center">
                        <span class="text-2xl">📦</span>
                    </div>
                    <div>
                        <h3 class="font-semibold">{{ $item->product->name }}</h3>
                        <p class="text-gray-600 text-sm">Price: ${{ number_format($item->price, 2) }}</p>
                        <p class="text-gray-600 text-sm">Quantity: {{ $item->quantity }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="font-bold text-lg">${{ number_format($item->price * $item->quantity, 2) }}</p>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Total -->
        <div class="border-t mt-4 pt-4 text-right">
            <p class="text-xl font-bold">Total: ${{ number_format($order->total, 2) }}</p>
        </div>
    </div>
</div>
@endsection