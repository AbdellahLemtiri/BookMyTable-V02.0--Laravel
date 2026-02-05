<?php

namespace Database\Factories;

use App\Models\Restaurateur;
use App\Models\TypeCuisine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom_restaurant' => fake()->company(),
            'adresse_restaurant' => fake()->address(),
            'telephone_restaurant' => fake()->phoneNumber(),
            'email_restaurant' => fake()->unique()->safeEmail(),
            'description_restaurant' => fake()->paragraph(),
            'type_cuisine_id' => TypeCuisine::factory(),
            'user_id' => Restaurateur::factory(),
        ];
    }
}
