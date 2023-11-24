<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Ingredient extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['name'];

    public function ingredientsListings() {
        return $this->hasMany(IngredientsListing::class);
    }
}
