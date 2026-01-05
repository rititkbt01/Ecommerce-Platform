@extends('layouts.app')

@section('content')
<!-- Breadcrumb -->
<div class="text-sm text-gray-600 mb-6">
    <a href="/" class="hover:text-blue-600">Home</a> / 
    <span class="text-gray-800">{{ $category->name }}</span>
</div>

<h1 class="text-4xl font-bold mb-8">{{ $category->name }}</h1>

<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
    <!-- Sidebar - Categories -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow p-6 sticky top-4">
            <h2 class="text-xl font-bold mb-4">Categories</h2>
            <ul class="space-y-2">
                @foreach($categories as $cat)
                <li>
                    <a href="{{ route('category.show', $cat->slug) }}" 
                       class="flex justify-between items-center py-2 px-3 rounded hover:bg-gray-100 transition
                              {{ $cat->id === $category->id ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-700' }}">
                        <span>{{ $cat->name }}</span>
                        <span class="text-sm text-gray-500">({{ $cat->products_count }})</span>
                    </a>
                </li>
                @endforeach
            </ul>
            
            <!-- Back to All Products -->
            <a href="/" class="block mt-6 text-center text-blue-600 hover:underline">
                ← View All Products
            </a>
        </div>
    </div>
    
    <!-- Products Grid -->
    <div class="lg:col-span-3">
        @if($products->isEmpty())
            <!-- No Products -->
            <div class="bg-white p-12 rounded-lg shadow text-center">
                <p class="text-gray-600 text-lg mb-4">No products found in this category.</p>
                <a href="/" class="text-blue-600 hover:underline">Browse all products</a>
            </div>
        @else
            <!-- Products Count -->
            <p class="text-gray-600 mb-4">Showing {{ $products->total() }} products</p>
            
            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
                    <!-- Product Image -->
                    <a href="{{ route('product.show', $product->slug) }}">
                        <div class="bg-gray-200 h-48 rounded-t-lg flex items-center justify-center">
                            <span class="text-gray-400 text-4xl">📦</span>
                        </div>
                    </a>
                    
                    <!-- Product Info -->
                    <div class="p-4">
                        <a href="{{ route('product.show', $product->slug) }}">
                            <h3 class="font-semibold text-gray-800 mb-2 hover:text-blue-600">{{ $product->name }}</h3>
                        </a>
                        <p class="text-gray-600 text-sm mb-2 line-clamp-2">{{ Str::limit($product->description, 60) }}</p>
                        
                        <div class="flex justify-between items-center mt-4">
                            <span class="text-2xl font-bold text-blue-600">${{ number_format($product->price, 2) }}</span>
                            
                            @if($product->stock > 0)
                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                        Add to Cart
                                    </button>
                                </form>
                            @else
                                <button disabled class="bg-gray-300 text-gray-600 px-4 py-2 rounded cursor-not-allowed">
                                    Out of Stock
                                </button>
                            @endif
                        </div>
                        
                        <!-- Stock Info -->
                        <p class="text-sm text-gray-500 mt-2">
                            @if($product->stock > 0)
                                In Stock: {{ $product->stock }}
                            @else
                                <span class="text-red-500">Out of Stock</span>
                            @endif
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="mt-8">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>
@endsection