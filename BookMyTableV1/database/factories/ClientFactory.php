<?php
// database/factories/ClientFactory.php
namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition(): array
    {
        return [
            'username' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => bcrypt('password'),
            'role' => 'client',
            'nom' => fake()->lastName(),
            'prenom' => fake()->firstName(),
            'phone' => fake()->phoneNumber(),

        ];
    }
}
