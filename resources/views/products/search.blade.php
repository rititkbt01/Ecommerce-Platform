@extends('layouts.app')

@section('content')
<!-- Search Header -->
<div class="mb-8">
    <h1 class="text-4xl font-bold mb-2">Search Results</h1>
    <p class="text-gray-600">
        Showing results for: <strong>"{{ $query }}"</strong> 
        @if($products->total() > 0)
            ({{ $products->total() }} {{ Str::plural('product', $products->total()) }} found)
        @endif
    </p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
    <!-- Sidebar - Categories -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow p-6 sticky top-4">
            <h2 class="text-xl font-bold mb-4">Filter by Category</h2>
            <ul class="space-y-2">
                @foreach($categories as $category)
                <li>
                    <a href="{{ route('category.show', $category->slug) }}" 
                       class="flex justify-between items-center py-2 px-3 rounded hover:bg-gray-100 transition text-gray-700">
                        <span>{{ $category->name }}</span>
                        <span class="text-sm text-gray-500">({{ $category->products_count }})</span>
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
    
    <!-- Search Results -->
    <div class="lg:col-span-3">
        @if($products->isEmpty())
            <!-- No Results -->
            <div class="bg-white p-12 rounded-lg shadow text-center">
                <div class="text-6xl mb-4">🔍</div>
                <h2 class="text-2xl font-bold mb-2">No products found</h2>
                <p class="text-gray-600 mb-6">
                    We couldn't find any products matching "<strong>{{ $query }}</strong>"
                </p>
                <div class="space-x-4">
                    <a href="/" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 inline-block">
                        Browse All Products
                    </a>
                    <button onclick="document.getElementById('searchInput').focus()" 
                            class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400 inline-block">
                        Try Another Search
                    </button>
                </div>
            </div>
        @else
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
                        <!-- Category Badge -->
                        <a href="{{ route('category.show', $product->category->slug) }}" 
                           class="inline-block text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded mb-2 hover:bg-gray-200">
                            {{ $product->category->name }}
                        </a>
                        
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
                {{ $products->appends(['query' => $query])->links() }}
            </div>
        @endif
    </div>
</div>
@endsection