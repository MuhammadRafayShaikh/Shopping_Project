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
            $table->id();
            $table->string('product_name');
            $table->longText('product_desc');
            $table->integer('product_price');
            $table->text('product_image');
            $table->integer('product_qty');
            $table->integer('product_views')->default(0);
            $table->foreignId('product_cat')->constrained('categories');
            $table->foreignId('product_sub_cat')->constrained('subcategories');
            $table->foreignId('product_brand')->constrained('brands');
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
