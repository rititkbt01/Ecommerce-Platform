@extends('layouts.admin')

@section('content')
<h1 class="text-3xl font-bold mb-8">All Orders</h1>

<!-- Orders Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($orders as $order)
            <tr>
                <td class="px-6 py-4">#{{ $order->id }}</td>
                <td class="px-6 py-4">
                    {{ $order->name }}<br>
                    <span class="text-sm text-gray-500">{{ $order->email }}</span>
                </td>
                <td class="px-6 py-4">{{ $order->created_at->format('M d, Y') }}</td>
                <td class="px-6 py-4 font-bold">${{ number_format($order->total, 2) }}</td>
                <td class="px-6 py-4">
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                        @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                        @elseif($order->status === 'completed') bg-green-100 text-green-800
                        @else bg-red-100 text-red-800
                        @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-600 hover:underline">
                        View Details
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="mt-4">
    {{ $orders->links() }}
</div>
@endsection