<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\Horaire;
use Carbon\Carbon;

class HoraireSeeder extends Seeder
{
    public function run(): void
    {
        
        $restaurants = Restaurant::all();
 
        $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

        $dataToInsert = [];
        $now = Carbon::now();

        foreach ($restaurants as $restaurant) {
            foreach ($jours as $jour) {
                
            
                $isWeekend = in_array($jour, ['Vendredi', 'Samedi', 'Dimanche']);
                $heure_ouverture = '09:00:00';
                $heure_fermeture = $isWeekend ? '23:00:00' : '22:00:00';
        
                $ferme = ($jour === 'Lundi' && $restaurant->id % 2 === 0);

                $dataToInsert[] = [
                    'restaurant_id' => $restaurant->id,
                    'jour' => $jour,
                    'heure_ouverture' => $heure_ouverture,
                    'heure_fermeture' => $heure_fermeture,
                    'ferme' => $ferme,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

      
        Horaire::query()->truncate(); 
        Horaire::insert($dataToInsert);
    }
}