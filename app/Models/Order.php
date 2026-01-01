<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total',
        'status',
        'name',
        'email',
        'address',
        'phone',
    ];

    // Relationship: Order belongs to User (optional - guest checkout allowed)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: Order has many OrderItems
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}