<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable=[
        'order_id',
        'product_id',
        'varient_id',
        'quantity',

    ];
    function order()
    {
        return $this->belongsTo(Order::class);
    }
    function product()
    {
        return $this->belongsTo(Product::class);
    }
    function variant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
