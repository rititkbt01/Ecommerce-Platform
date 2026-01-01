<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
    ];

    // Relationship: Product belongs to Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship: Product can be in many OrderItems
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}