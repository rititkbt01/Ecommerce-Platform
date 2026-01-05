@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
    <!-- Product Image -->
    <div class="bg-white rounded-lg shadow p-8">
        <div class="bg-gray-200 h-96 rounded-lg flex items-center justify-center">
            <span class="text-gray-400 text-8xl">📦</span>
        </div>
    </div>
    
    <!-- Product Info -->
    <div>

        <!-- Breadcrumb -->
       <div class="text-sm text-gray-600 mb-4">
           <a href="/" class="hover:text-blue-600">Home</a> / 
           <a href="{{ route('category.show', $product->category->slug) }}" class="hover:text-blue-600">{{ $product->category->name }}</a> / 
           <span class="text-gray-800">{{ $product->name }}</span>
        </div>
                
        <h1 class="text-4xl font-bold mb-4">{{ $product->name }}</h1>
        
        <!-- Price -->
        <div class="mb-6">
            <span class="text-4xl font-bold text-blue-600">${{ number_format($product->price, 2) }}</span>
        </div>
        
        <!-- Stock Status -->
        <div class="mb-6">
            @if($product->stock > 0)
                <span class="inline-block bg-green-100 text-green-800 px-4 py-2 rounded-full font-semibold">
                    ✓ In Stock ({{ $product->stock }} available)
                </span>
            @else
                <span class="inline-block bg-red-100 text-red-800 px-4 py-2 rounded-full font-semibold">
                    ✗ Out of Stock
                </span>
            @endif
        </div>
        
        <!-- Description -->
        <div class="mb-8">
            <h2 class="text-xl font-bold mb-3">Product Description</h2>
            <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
        </div>
        
        <!-- Product Details -->
        <div class="bg-gray-50 p-6 rounded-lg mb-8">
            <h2 class="text-xl font-bold mb-3">Product Details</h2>
            <ul class="space-y-2 text-gray-700">
                <li><strong>Category:</strong> {{ $product->category->name }}</li>
                <li><strong>SKU:</strong> {{ strtoupper(substr($product->slug, 0, 8)) }}</li>
                <li><strong>Availability:</strong> {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}</li>
            </ul>
        </div>
        
        <!-- Add to Cart Button -->
        @if($product->stock > 0)
            <form action="{{ route('cart.add', $product) }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-blue-500 text-white py-4 rounded-lg hover:bg-blue-600 font-bold text-lg">
                    🛒 Add to Cart
                </button>
            </form>
        @else
            <button disabled class="w-full bg-gray-300 text-gray-600 py-4 rounded-lg cursor-not-allowed font-bold text-lg">
                Out of Stock
            </button>
        @endif
    </div>
</div>

<!-- Related Products -->
@if($relatedProducts->count() > 0)
<div class="border-t pt-12">
    <h2 class="text-3xl font-bold mb-8">You May Also Like</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($relatedProducts as $relatedProduct)
        <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
            <a href="{{ route('product.show', $relatedProduct->slug) }}">
                <div class="bg-gray-200 h-48 rounded-t-lg flex items-center justify-center">
                    <span class="text-gray-400 text-4xl">📦</span>
                </div>
                
                <div class="p-4">
                    <h3 class="font-semibold text-gray-800 mb-2">{{ $relatedProduct->name }}</h3>
                    <p class="text-2xl font-bold text-blue-600">${{ number_format($relatedProduct->price, 2) }}</p>
                    
                    @if($relatedProduct->stock > 0)
                        <p class="text-sm text-green-600 mt-2">In Stock</p>
                    @else
                        <p class="text-sm text-red-600 mt-2">Out of Stock</p>
                    @endif
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endif
@endsection