<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restaurant extends Model
{
    use HasFactory;

    protected $table = 'restaurants';

    protected $fillable = [
        'nom_restaurant',
        'adresse_restaurant',
        'telephone_restaurant',
        'description_restaurant',
        'capacite_restaurant',
        'type_cuisine_id',
        'user_id',
    ];


    public function restaurateur()
    {
        return $this->belongsTo(Restaurateur::class, 'user_id');
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class, 'favoris', 'user_id', 'restaurant_id')->withTimestamps();
    }

    public function typeCuisine()
    {
        return $this->belongsTo(TypeCuisine::class, 'type_cuisine_id');
    }

    public function horaires()
    {
        return $this->hasMany(Horaire::class);
    }


    public function menus()
    {
        return $this->hasOne(Menu::class);
    }


    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
