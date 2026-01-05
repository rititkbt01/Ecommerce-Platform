@extends('layouts.admin')

@section('content')
<div class="max-w-4xl">
    <!-- Back Button -->
    <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">
        ← Back to Orders
    </a>
    
    <h1 class="text-3xl font-bold mb-8">Order #{{ $order->id }}</h1>
    
    <!-- Update Status Form -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-xl font-bold mb-4">Update Order Status</h2>
        <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="flex items-center space-x-4">
            @csrf
            @method('PATCH')
            
            <select name="status" class="px-4 py-2 border rounded-lg">
                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                Update Status
            </button>
        </form>
    </div>
    
    <!-- Order Info -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-xl font-bold mb-4">Order Information</h2>
        
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <p class="text-gray-600 text-sm">Order Date</p>
                <p class="font-bold">{{ $order->created_at->format('M d, Y - h:i A') }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Total Amount</p>
                <p class="font-bold text-xl text-blue-600">${{ number_format($order->total, 2) }}</p>
            </div>
        </div>
        
        <!-- Customer Information -->
        <div class="border-t pt-4">
            <h3 class="font-bold mb-2">Customer Information</h3>
            <p class="text-gray-700"><strong>Name:</strong> {{ $order->name }}</p>
            <p class="text-gray-700"><strong>Email:</strong> {{ $order->email }}</p>
            <p class="text-gray-700"><strong>Phone:</strong> {{ $order->phone }}</p>
            <p class="text-gray-700"><strong>Address:</strong> {{ $order->address }}</p>
            @if($order->user)
                <p class="text-gray-700 mt-2"><strong>Registered User:</strong> Yes (User ID: {{ $order->user->id }})</p>
            @else
                <p class="text-gray-700 mt-2"><strong>Registered User:</strong> No (Guest Checkout)</p>
            @endif
        </div>
    </div>
    
    <!-- Order Items -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-4">Order Items</h2>
        
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left">Product</th>
                    <th class="px-4 py-2 text-left">Price</th>
                    <th class="px-4 py-2 text-left">Quantity</th>
                    <th class="px-4 py-2 text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach($order->orderItems as $item)
                <tr>
                    <td class="px-4 py-3">{{ $item->product->name }}</td>
                    <td class="px-4 py-3">${{ number_format($item->price, 2) }}</td>
                    <td class="px-4 py-3">{{ $item->quantity }}</td>
                    <td class="px-4 py-3 text-right font-bold">${{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-gray-50">
                <tr>
                    <td colspan="3" class="px-4 py-3 text-right font-bold">Total:</td>
                    <td class="px-4 py-3 text-right font-bold text-xl">${{ number_format($order->total, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection