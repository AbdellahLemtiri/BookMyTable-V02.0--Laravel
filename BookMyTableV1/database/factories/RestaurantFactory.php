<?php

namespace Database\Factories;

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
            'user_id' => User::factory(), 
            'name' => fake()->company() . ' Restaurant',
            'description' => fake()->paragraph(),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'phone' => fake()->phoneNumber(),
            'is_active' => true,
        ];
    }
}
