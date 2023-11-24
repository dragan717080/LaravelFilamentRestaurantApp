<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Order extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'recipes_orders');
    }
}
