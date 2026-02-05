<?php

namespace Database\Seeders;

use App\Models\Restaurateur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Restaurateur::factory()->count(10)->create()->each(function ($restaurateur) {
            $restaurateur->assignRole('restaurateur');
        });
    }
}
