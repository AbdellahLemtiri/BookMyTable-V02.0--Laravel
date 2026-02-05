<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Horaire>
 */
class HoraireFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'jour' => fake()->dayOfWeek(),
            'heure_ouverture' => fake()->time(),
            'heure_fermeture' => fake()->time(),
            'restaurant_id' => Restaurant::factory(),
        ];
    }
}
