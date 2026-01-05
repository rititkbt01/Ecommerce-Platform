<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

class ProductController extends Controller
{
    // Show single product detail
    public function show(Product $product)
    {
        // Load the category relationship
        $product->load('category');
        
        // Get related products (same category, exclude current product)
        $relatedProducts = Product::where('category_id', $product->category_id)
                                  ->where('id', '!=', $product->id)
                                  ->take(4)
                                  ->get();
        
        return view('products.show', compact('product', 'relatedProducts'));
    }

    // Search products
    public function search(Request $request)
    {
    $query = $request->input('query');
    
    // If no search query, redirect to homepage
    if (empty($query)) {
        return redirect('/')->with('error', 'Please enter a search term.');
    }
    
    // Search in product name and description
    $products = Product::where('name', 'LIKE', "%{$query}%")
                       ->orWhere('description', 'LIKE', "%{$query}%")
                       ->with('category')
                       ->paginate(12);
    
    // Get all categories for sidebar
    $categories = Category::withCount('products')->get();
    
    return view('products.search', compact('products', 'query', 'categories'));
    }
}