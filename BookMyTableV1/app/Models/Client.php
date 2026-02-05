<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Parental\HasParent;

class Client extends User
{
    use HasParent;
    protected $childColumnValue = 'client';
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'phone',
        'avatar',
    ];

    public function restaurants()
    {
        return  $this->belongsToMany(Restaurant::class, 'favoris', 'user_id', 'restaurant_id')->withTimestamps();
    }
}
