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
        Schema::create('orderstore', function (Blueprint $table) {
            $table->id('order_id'); 
            $table->string('customer_name'); 
            $table->string('phone_number');
            $table->unsignedBigInteger('product_id'); 
            $table->integer('quantity'); 
            $table->enum('unit', ['5', '10', '25', '50']); 
            $table->decimal('price', 8, 2); 
            $table->string('method'); 
            $table->string('location')->nullable(); 
            $table->date('order_date'); 
            $table->enum('order_status', ['pending', 'shipped', 'delivered'])->default('pending'); 
            $table->timestamps();

            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderstore');
    }
};
