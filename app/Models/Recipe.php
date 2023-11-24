<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipe extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = ['title', 'image_url', 'steps', 'price'];

    public function ingredientsListings() {
        return $this->hasMany(IngredientListing::class);        
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
