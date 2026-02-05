<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeCuisine extends Model
{
    use HasFactory;
    protected $table = 'type_cuisines';
    public function restaurants()
    {
        return $this->hasMany(Restaurant::class);
    }
}
