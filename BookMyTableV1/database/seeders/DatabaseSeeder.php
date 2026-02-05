<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
   public function run(): void
    {
  
        $this->call(RoleSeeder::class);
 
        $categories = Category::factory(8)->create();

    
        User::factory(10)->create()->each(function ($user) use ($categories) {
            $user->assignRole('restaurateur');

            $restaurant = Restaurant::factory()->create(['user_id' => $user->id]);
             
            $restaurant->categories()->attach($categories->random(2));

         
            MenuItem::factory(15)->create(['restaurant_id' => $restaurant->id]);
        });
        
        echo "✅ 10 Restaurants, 150 Plats, Admin créé.";
    }
}
