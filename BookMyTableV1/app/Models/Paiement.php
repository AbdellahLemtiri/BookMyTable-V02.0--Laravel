<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Paiement extends Model
{
    //
 use HasFactory;
    protected $fillable = [
        'reservation_id',
        'montant',
        'methode_paiement',
        'statut',
        'date_paiement',
        'transaction_id'
    ];


    protected $casts = ['date_paiement'=>'date'];
    public function Reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
      public function user()
    {
        return $this->belongsTo(User::class);
    }
}
