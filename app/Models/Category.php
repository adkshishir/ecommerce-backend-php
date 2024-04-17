<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends BaseModel
{
    use HasFactory;
    protected $fillable=[
        'parent_id',
        'name',
        'description',
        'slug',
        'status',
    ];
    function parentCategory(){
        return $this->belongsTo(Category::class,'parent_id');
    }
    function products(){
        return $this->hasMany(Product::class);
    }
    function getImageUrlAttribute(){
        $this->getFile();
    }

}
