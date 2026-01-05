@extends('layouts.admin')

@section('content')
<h1 class="text-3xl font-bold mb-8">Admin Dashboard</h1>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <!-- Total Products -->
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="text-gray-500 text-sm uppercase tracking-wide">Total Products</div>
        <div class="text-4xl font-bold text-blue-600 mt-2">{{ $stats['total_products'] }}</div>
    </div>

    <!-- Total Orders -->
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="text-gray-500 text-sm uppercase tracking-wide">Total Orders</div>
        <div class="text-4xl font-bold text-green-600 mt-2">{{ $stats['total_orders'] }}</div>
    </div>

    <!-- Total Customers -->
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="text-gray-500 text-sm uppercase tracking-wide">Total Customers</div>
        <div class="text-4xl font-bold text-purple-600 mt-2">{{ $stats['total_customers'] }}</div>
    </div>

    <!-- Total Revenue -->
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="text-gray-500 text-sm uppercase tracking-wide">Total Revenue</div>
        <div class="text-4xl font-bold text-yellow-600 mt-2">${{ number_format($stats['total_revenue'], 2) }}</div>
    </div>
</div>

<!-- Quick Actions -->
<!-- Quick Actions -->
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6">Quick Actions</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <a href="{{ route('admin.products.create') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-lg hover:from-blue-600 hover:to-blue-700 transform hover:scale-105 transition shadow-lg">
            <div class="flex items-center space-x-4">
                <div class="text-4xl">➕</div>
                <div>
                    <h3 class="text-xl font-bold">Add New Product</h3>
                    <p class="text-blue-100">Create a new product listing</p>
                </div>
            </div>
        </a>
        
        <a href="{{ route('admin.products.index') }}" class="bg-gradient-to-r from-green-500 to-green-600 text-white p-6 rounded-lg hover:from-green-600 hover:to-green-700 transform hover:scale-105 transition shadow-lg">
            <div class="flex items-center space-x-4">
                <div class="text-4xl">📦</div>
                <div>
                    <h3 class="text-xl font-bold">Manage Products</h3>
                    <p class="text-green-100">Edit, delete or view products</p>
                </div>
            </div>
        </a>
    </div>
</div>


<!-- Recent Products -->
<div class="bg-white p-6 rounded-lg shadow mt-8">
    <h2 class="text-xl font-bold mb-4">Recent Products</h2>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Stock</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse(App\Models\Product::with('category')->latest()->take(5)->get() as $product)
                <tr>
                    <td class="px-4 py-3">{{ $product->name }}</td>
                    <td class="px-4 py-3">{{ $product->category->name }}</td>
                    <td class="px-4 py-3">${{ number_format($product->price, 2) }}</td>
                    <td class="px-4 py-3">{{ $product->stock }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                        No products found. <a href="{{ route('admin.products.create') }}" class="text-blue-500 hover:underline">Add your first product</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection