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
        // Drop the products table if it exists to avoid conflicts
        // if (Schema::hasTable('products')) {
        //     Schema::drop('products');
        // }

        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('rice_type', 45);
            $table->integer('unit');
            $table->float('unit_price');
            $table->float('selling_price')->default(0.0);
            $table->integer('target_level');
            $table->integer('reorder_level');
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
