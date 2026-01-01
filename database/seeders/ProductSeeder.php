<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Get categories
        $electronics = Category::where('slug', 'electronics')->first();
        $clothing = Category::where('slug', 'clothing')->first();
        $books = Category::where('slug', 'books')->first();
        $home = Category::where('slug', 'home-garden')->first();
        $sports = Category::where('slug', 'sports-outdoors')->first();

        // Electronics products
        Product::create([
            'category_id' => $electronics->id,
            'name' => 'Wireless Bluetooth Headphones',
            'slug' => Str::slug('Wireless Bluetooth Headphones'),
            'description' => 'High-quality wireless headphones with noise cancellation and 30-hour battery life.',
            'price' => 79.99,
            'stock' => 50,
        ]);

        Product::create([
            'category_id' => $electronics->id,
            'name' => 'Smart Watch Pro',
            'slug' => Str::slug('Smart Watch Pro'),
            'description' => 'Fitness tracker with heart rate monitor, GPS, and water resistance.',
            'price' => 199.99,
            'stock' => 30,
        ]);

        Product::create([
            'category_id' => $electronics->id,
            'name' => 'USB-C Fast Charger',
            'slug' => Str::slug('USB-C Fast Charger'),
            'description' => '65W fast charging adapter compatible with all USB-C devices.',
            'price' => 29.99,
            'stock' => 100,
        ]);

        // Clothing products
        Product::create([
            'category_id' => $clothing->id,
            'name' => 'Classic Cotton T-Shirt',
            'slug' => Str::slug('Classic Cotton T-Shirt'),
            'description' => 'Comfortable 100% cotton t-shirt available in multiple colors.',
            'price' => 19.99,
            'stock' => 200,
        ]);

        Product::create([
            'category_id' => $clothing->id,
            'name' => 'Denim Jeans',
            'slug' => Str::slug('Denim Jeans'),
            'description' => 'Premium denim jeans with a modern fit.',
            'price' => 49.99,
            'stock' => 75,
        ]);

        // Books
        Product::create([
            'category_id' => $books->id,
            'name' => 'Laravel: From Beginner to Professional',
            'slug' => Str::slug('Laravel: From Beginner to Professional'),
            'description' => 'Comprehensive guide to mastering Laravel framework.',
            'price' => 39.99,
            'stock' => 25,
        ]);

        Product::create([
            'category_id' => $books->id,
            'name' => 'Clean Code by Robert Martin',
            'slug' => Str::slug('Clean Code by Robert Martin'),
            'description' => 'A handbook of agile software craftsmanship.',
            'price' => 44.99,
            'stock' => 15,
        ]);

        // Home & Garden
        Product::create([
            'category_id' => $home->id,
            'name' => 'Indoor Plant Pot Set',
            'slug' => Str::slug('Indoor Plant Pot Set'),
            'description' => 'Set of 3 ceramic plant pots with drainage holes.',
            'price' => 24.99,
            'stock' => 40,
        ]);

        // Sports & Outdoors
        Product::create([
            'category_id' => $sports->id,
            'name' => 'Yoga Mat Premium',
            'slug' => Str::slug('Yoga Mat Premium'),
            'description' => 'Non-slip yoga mat with carrying strap, 6mm thick.',
            'price' => 34.99,
            'stock' => 60,
        ]);

        Product::create([
            'category_id' => $sports->id,
            'name' => 'Water Bottle 1L',
            'slug' => Str::slug('Water Bottle 1L'),
            'description' => 'Stainless steel insulated water bottle keeps drinks cold for 24 hours.',
            'price' => 19.99,
            'stock' => 150,
        ]);
    }
}