<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Parental\HasParent;

class Restaurateur extends User
{
    use HasParent;
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'avatar',
    ];

    public function restaurants()
    {
        return $this->hasMany(Restaurant::class);
    }
}
