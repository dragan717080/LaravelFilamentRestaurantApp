<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ingredients_listings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('quantity')->unsigned();
            $table->string('measure_unit')->nullable();
            $table->string('recipe_title')->nullable();
            $table->foreign('recipe_title')->references('title')->on('recipes');
            $table->string('ingredient_name');
            $table->foreign('ingredient_name')->references('name')->on('ingredients');
            $table->softDeletes();
            $table->timestamps();

            /* It is possible to add check by importing Illuminate\Support\Facades\DB and using
            DB::statement("ALTER TABLE ingredients_listings ADD CONSTRAINT chk_measure_unit CHECK (measure_unit IN ('ml', 'l', 'kg', 'g'));");  */
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ingredients_listings');
    }
};
