<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\Menu;
use App\Models\Plat;
use Illuminate\Support\Facades\Schema;

class MenuSeeder extends Seeder
{
    public function run(): void
    { 
        Schema::disableForeignKeyConstraints();
        Plat::truncate();  
        Menu::truncate();  
        Schema::enableForeignKeyConstraints();
 
        $restaurants = Restaurant::all();

       
        $foodList = [
            ['nom_plat' => 'Salade César', 'prix_plat' => 65.00],
            ['nom_plat' => 'Tajine de Poulet au Citron', 'prix_plat' => 90.00],
            ['nom_plat' => 'Burger Cheese Maison', 'prix_plat' => 85.00],
            ['nom_plat' => 'Pizza Margherita', 'prix_plat' => 70.00],
            ['nom_plat' => 'Pasta Carbonara', 'prix_plat' => 95.00],
            ['nom_plat' => 'Sushi Mix (12 pcs)', 'prix_plat' => 120.00],
            ['nom_plat' => 'Steak Frites', 'prix_plat' => 150.00],
            ['nom_plat' => 'Soupe de Poisson', 'prix_plat' => 60.00],
            ['nom_plat' => 'Tiramisu', 'prix_plat' => 50.00],
            ['nom_plat' => 'Cheesecake aux Fruits Rouges', 'prix_plat' => 55.00],
            ['nom_plat' => 'Jus d\'Orange Pressé', 'prix_plat' => 25.00],
            ['nom_plat' => 'Thé Marocain', 'prix_plat' => 20.00],
        ];

     
        foreach ($restaurants as $restaurant) {
     
            $menu = Menu::create([
                'restaurant_id' => $restaurant->id,
            ]);
 
            $randomDishes = collect($foodList)->random(5);

            foreach ($randomDishes as $dish) {
                Plat::create([
                    'nom_plat' => $dish['nom_plat'],
                    'prix_plat' => $dish['prix_plat'],
                    'menu_id' => $menu->id, 
                ]);
            }
        }
    }
}