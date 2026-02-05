<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    /** @use HasFactory<\Database\Factories\RestaurantFactory> */
    use HasFactory;


protected $fillable = [
        'user_id',
        'name',
        'description',
        'address',
        'city',
        'phone',
        'is_active'
    ];

  
 
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
 
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_restaurant');
    }
 
    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
 
    public function images()
    {
        return $this->hasMany(RestaurantImage::class);
    }
 
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

     
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    
}
