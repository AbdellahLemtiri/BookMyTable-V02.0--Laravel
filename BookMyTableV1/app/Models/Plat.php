<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plat extends Model
{
    use HasFactory;
    protected $table = 'plats';
    protected $fillable = ['nom_plat', 'prix_plat', 'menu_id'];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
