<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
}