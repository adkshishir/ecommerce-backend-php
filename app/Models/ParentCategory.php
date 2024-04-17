<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentCategory extends BaseModel
{
    use HasFactory;
 protected $fillable = [
        'name',
        'slug',
        'description',
        'status'
 ];
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
     function getImageUrlAttribute(){
        $this->getFile();
     }
}
