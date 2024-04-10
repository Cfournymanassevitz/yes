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
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('description');
            $table->string('story');
            $table->float('price');
            $table->integer('quantity');
            $table->string('image');
            $table->string('material');
            $table->string('color');
            $table->string('size');
            $table->string('category');
            $table->foreignUuid('store_id')->nullable()->references('id')->on('stores')->onDelete('cascade');
/*            $table->foreignUuid('category_id')->nullable()->constrained('categories')->onDelete('cascade');*/
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
