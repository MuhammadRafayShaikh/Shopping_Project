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
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();
            $table->string('sub_cat_name')->unique();
            $table->foreignId('cat_name')->constrained('categories');
            $table->integer('cat_products')->default(0);
            $table->tinyInteger('s_i_header')->default(0);
            $table->tinyInteger('s_i_footer')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategories');
    }
};
