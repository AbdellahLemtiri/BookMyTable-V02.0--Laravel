<?php

namespace Database\Seeders;

use App\Models\TypeCuisine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeCuisineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeCuisine::factory()->count(10)->create();
    }
}
