@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-8">My Orders</h1>

@if($orders->isEmpty())
    <!-- No Orders -->
    <div class="bg-white p-8 rounded-lg shadow text-center">
        <p class="text-gray-600 text-lg mb-4">You haven't placed any orders yet.</p>
        <a href="/" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
            Start Shopping
        </a>
    </div>
@else
    <!-- Orders List -->
    <div class="space-y-4">
        @foreach($orders as $order)
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-xl font-bold">Order #{{ $order->id }}</h3>
                    <p class="text-gray-600 text-sm">{{ $order->created_at->format('M d, Y - h:i A') }}</p>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-bold text-blue-600">${{ number_format($order->total, 2) }}</p>
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                        @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                        @elseif($order->status === 'completed') bg-green-100 text-green-800
                        @else bg-red-100 text-red-800
                        @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>
            
            <div class="border-t pt-4 mb-4">
                <p class="text-gray-700"><strong>Items:</strong> {{ $order->orderItems->count() }}</p>
                <p class="text-gray-700"><strong>Shipping to:</strong> {{ $order->address }}</p>
            </div>
            
            <a href="{{ route('orders.show', $order) }}" 
               class="text-blue-600 hover:underline font-semibold">
                View Details →
            </a>
        </div>
        @endforeach
    </div>


    <!-- Pagination -->
    @if($orders instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="mt-6">
        {{ $orders->links() }}
    </div>
    @endif
     
@endif
@endsection