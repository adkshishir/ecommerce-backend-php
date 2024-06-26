<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'nickname',
        'avatar',
        'bio'

    ];
    protected $hidden=[
        'user_id'
    ];
    public function user(){
        $this->belongsTo(User::class);
        
    }
}
