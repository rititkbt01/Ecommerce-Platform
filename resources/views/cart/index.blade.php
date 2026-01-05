@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-8">Shopping Cart</h1>

@if(empty($cart))
    <!-- Empty Cart -->
    <div class="bg-white p-8 rounded-lg shadow text-center">
        <p class="text-gray-600 text-lg mb-4">Your cart is empty</p>
        <a href="/" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
            Continue Shopping
        </a>
    </div>
@else
    <!-- Cart Items -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Cart Items List -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow">
                @foreach($cart as $id => $item)
                <div class="p-6 border-b last:border-b-0">
                    <div class="flex items-center justify-between">
                        <!-- Product Info -->
                        <div class="flex items-center space-x-4 flex-1">
                            <div class="bg-gray-200 w-20 h-20 rounded flex items-center justify-center">
                                <span class="text-3xl">📦</span>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-lg">{{ $item['name'] }}</h3>
                                <p class="text-gray-600">${{ number_format($item['price'], 2) }}</p>
                            </div>
                        </div>

                        <!-- Quantity Update -->
                        <div class="flex items-center space-x-4">
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" 
                                       min="1" class="w-16 px-2 py-1 border rounded text-center">
                                <button type="submit" class="ml-2 text-blue-600 hover:underline text-sm">
                                    Update
                                </button>
                            </form>

                            <!-- Remove Button -->
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-sm">
                                    Remove
                                </button>
                            </form>
                        </div>

                        <!-- Subtotal -->
                        <div class="ml-4 text-right">
                            <p class="font-bold text-lg">
                                ${{ number_format($item['price'] * $item['quantity'], 2) }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Clear Cart Button -->
            <div class="mt-4">
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline" 
                            onclick="return confirm('Are you sure you want to clear your cart?')">
                        Clear Cart
                    </button>
                </form>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white p-6 rounded-lg shadow sticky top-4">
                <h2 class="text-xl font-bold mb-4">Order Summary</h2>
                
                <div class="space-y-2 mb-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Shipping</span>
                        <span>Free</span>
                    </div>
                    <div class="border-t pt-2 flex justify-between font-bold text-lg">
                        <span>Total</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                </div>

                <a href="{{ route('checkout.index') }}" 
                   class="block w-full bg-blue-500 text-white text-center py-3 rounded hover:bg-blue-600">
                    Proceed to Checkout
                </a>

                <a href="/" class="block w-full text-center text-gray-600 mt-4 hover:underline">
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>
@endif
@endsection