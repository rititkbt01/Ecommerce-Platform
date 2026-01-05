@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-8">Checkout</h1>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Checkout Form -->
    <div class="lg:col-span-2">
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4">Shipping Information</h2>
            
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                
                <!-- Name -->
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Full Name *</label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name ?? '') }}" 
                           class="w-full px-4 py-2 border rounded-lg @error('name') border-red-500 @enderror"
                           required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Email *</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" 
                           class="w-full px-4 py-2 border rounded-lg @error('email') border-red-500 @enderror"
                           required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Phone -->
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Phone Number *</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}" 
                           class="w-full px-4 py-2 border rounded-lg @error('phone') border-red-500 @enderror"
                           required>
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Address -->
                <div class="mb-6">
                    <label class="block text-gray-700 mb-2">Shipping Address *</label>
                    <textarea name="address" rows="3" 
                              class="w-full px-4 py-2 border rounded-lg @error('address') border-red-500 @enderror"
                              required>{{ old('address') }}</textarea>
                    @error('address')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="w-full bg-green-500 text-white py-3 rounded-lg hover:bg-green-600 font-bold">
                    Place Order - ${{ number_format($total, 2) }}
                </button>
            </form>
        </div>
    </div>
    
    <!-- Order Summary -->
    <div class="lg:col-span-1">
        <div class="bg-white p-6 rounded-lg shadow sticky top-4">
            <h2 class="text-xl font-bold mb-4">Order Summary</h2>
            
            <!-- Cart Items -->
            <div class="space-y-3 mb-4 border-b pb-4">
                @foreach($cart as $id => $item)
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">
                        {{ $item['name'] }} × {{ $item['quantity'] }}
                    </span>
                    <span class="font-semibold">
                        ${{ number_format($item['price'] * $item['quantity'], 2) }}
                    </span>
                </div>
                @endforeach
            </div>
            
            <!-- Totals -->
            <div class="space-y-2 mb-4">
                <div class="flex justify-between">
                    <span class="text-gray-600">Subtotal</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Shipping</span>
                    <span class="text-green-600">Free</span>
                </div>
                <div class="border-t pt-2 flex justify-between font-bold text-lg">
                    <span>Total</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>
            </div>
            
            <a href="{{ route('cart.index') }}" class="block text-center text-blue-600 hover:underline">
                ← Back to Cart
            </a>
        </div>
    </div>
</div>
@endsection