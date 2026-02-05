<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
    */
    public function definition(): array
    {
        return [
            'username' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // 'password' => bcrypt('password')
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Create a new factory instance for the model.
     */
    public function client(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'client', 
            'nom' => fake()->lastName(),
            'prenom' => fake()->firstName(),
            'telephone' => fake()->phoneNumber(),
        ]);
    }

    /**
     */
    public function restaurateur(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'restaurateur',
            'photo' => 'owners/default.jpg',
            'description' => fake()->paragraph(),
        ]);
    }

    /**
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'admin',
        ]);
    }
}