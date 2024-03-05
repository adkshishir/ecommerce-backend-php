<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable=[
        "user_id",
        "phone1",
        "phone2",
        "address1",
        "address2",
        "city",
        "country",
        "zip_code",
        "state",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
