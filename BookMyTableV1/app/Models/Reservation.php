<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    /** @use HasFactory<\Database\Factories\ReservationFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',          
        'restaurant_id',    
        'date_reservation',
        'heure_reservation',
        'nb_personnes',
        'statut',
        'total_price',
        'qr_code'
    ];
 
    protected $casts = [
        'date_reservation' => 'date',
        'total_price' => 'float',
        'nb_personnes' => 'integer',
    ];
 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
 
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
 
    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }
}