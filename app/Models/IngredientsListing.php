<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class IngredientsListing extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = ['quantity', 'measure_unit', 'recipe_title', 'ingredient_name'];

    public function recipe() {
        return $this->belongsTo(Recipe::class, 'recipe_title', 'title');
    }

    public function ingredient() {
        return $this->belongsTo(Ingredient::class);
    }
}
