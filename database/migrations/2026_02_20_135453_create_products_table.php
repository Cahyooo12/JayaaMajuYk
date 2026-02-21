<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('category');
            $table->integer('price');
            $table->integer('original_price')->nullable();
            $table->text('description');
            $table->string('image');
            $table->json('images')->nullable();
            $table->json('tags')->nullable();
            $table->boolean('is_ready_stock')->default(false);
            $table->boolean('is_best_seller')->default(false);
            $table->json('specs')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
