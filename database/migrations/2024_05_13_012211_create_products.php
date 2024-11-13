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
        
        if (Schema::hasTable('products')) {
            Schema::drop('products');
        }

        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string(column: 'image')->nullable();
            $table->string('rice_type');
            $table->enum('unit', ['5', '10', '25', '50']);
            $table->decimal('unit_price', 10, 2);
            $table->decimal('selling_price', 10, 2);
            $table->integer('target_level');
            $table->integer('reorder_level');
            $table->integer('current_quantity')->default(0);
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
