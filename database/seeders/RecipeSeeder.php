<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        Recipe::factory(10)->create();
    }
}
