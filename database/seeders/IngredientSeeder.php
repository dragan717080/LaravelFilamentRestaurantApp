<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Ingredient;

class IngredientSeeder extends Seeder
{
    public function run(): void
    {
        $jsonFile = Storage::get('ingredients.json');
        $ingredients = json_decode($jsonFile, true);

        foreach($ingredients as $ingredient) {
            Ingredient::create([
                'name' => $ingredient
            ]);
        }
    }
}
