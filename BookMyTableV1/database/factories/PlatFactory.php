<?php

namespace Database\Factories;

use App\Models\Categorie;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plat>
 */
class PlatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom_plat' => fake()->word(),
            'prix_plat' => fake()->randomFloat(2, 5, 100),
            'menu_id' => Menu::factory(),
        ];
    }
}
