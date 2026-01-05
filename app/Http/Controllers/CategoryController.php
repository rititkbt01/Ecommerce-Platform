<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Show all products in a category
    public function show(Category $category)
    {
        // Get products in this category with pagination
        $products = $category->products()->paginate(12);
        
        // Get all categories for the sidebar
        $categories = Category::withCount('products')->get();
        
        return view('categories.show', compact('category', 'products', 'categories'));
    }
}