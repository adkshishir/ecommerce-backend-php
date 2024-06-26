<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
protected $fillable = [
    'user_id',
    'product_id',
    'rating',
    'review',
];
 public function user(){
    $this->belongsTo(User::class);

 }
 public function product(){
    $this->belongsTo(Product::class);
 }
}
