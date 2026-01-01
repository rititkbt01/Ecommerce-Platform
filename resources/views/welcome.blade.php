@extends('layouts.app')

@section('content')
<div class="text-center mb-8">
    <h1 class="text-4xl font-bold text-gray-800 mb-4">Welcome to ShopEase</h1>
    <p class="text-gray-600 text-lg">Your one-stop shop for everything you need!</p>
</div>

<!-- Categories -->
<div class="mb-8">
    <h2 class="text-2xl font-bold mb-4">Shop by Category</h2>
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
        @foreach(\App\Models\Category::all() as $category)
            <a href="#" class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition text-center">
                <h3 class="font-semibold text-gray-800">{{ $category->name }}</h3>
            </a>
        @endforeach
    </div>
</div>

<!-- Featured Products -->
<div>
    <h2 class="text-2xl font-bold mb-4">Featured Products</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach(\App\Models\Product::take(8)->get() as $product)
            <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
                <!-- Product Image Placeholder -->
                <div class="bg-gray-200 h-48 rounded-t-lg flex items-center justify-center">
                    <span class="text-gray-400 text-4xl">📦</span>
                </div>
                
                <!-- Product Info -->
                <div class="p-4">
                    <h3 class="font-semibold text-gray-800 mb-2">{{ $product->name }}</h3>
                    <p class="text-gray-600 text-sm mb-2 line-clamp-2">{{ Str::limit($product->description, 60) }}</p>
                    
                    <div class="flex justify-between items-center mt-4">
                        <span class="text-2xl font-bold text-blue-600">${{ number_format($product->price, 2) }}</span>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Add to Cart
                        </button>
                    </div>
                    
                    <!-- Stock Info -->
                    <p class="text-sm text-gray-500 mt-2">
                        @if($product->stock > 0)
                            In Stock: {{ $product->stock }} available
                        @else
                            <span class="text-red-500">Out of Stock</span>
                        @endif
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection