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
        Schema::create('stock_requests', function (Blueprint $table) {
            $table->id('request_id');
            $table->foreignId('store_id')->constrained('store', 'store_id');
            $table->foreignId('product_id')->constrained('products', 'product_id');
            $table->integer('quantity_requested');
            $table->enum('status', ['pending', 'approved', 'rejected', 'delivered'])->default('pending');
            $table->timestamps();
        });
        
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_requests');
    }
};
