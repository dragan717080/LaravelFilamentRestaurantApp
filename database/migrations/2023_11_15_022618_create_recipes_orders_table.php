<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recipes_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('recipe_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('order_id')->nullable()->constrained()->onDelete('cascade');
            $table->unique(['recipe_id', 'order_id']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recipes_orders');
    }
};
