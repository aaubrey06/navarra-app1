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
        // Schema::create('order_details', function (Blueprint $table) {
        //     $table->id('orderdetails_id');
        //     $table->foreignId('order_id');
        //     $table->foreignId('product_id');
        //     $table->integer('quantity');
        //     $table->float('unit_price');
        // });

        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->string('rice_type');
            $table->integer('unit');
            $table->decimal('selling_price', 8, 2);
            $table->integer('quantity');
            $table->decimal('total_selling_price', 8, 2);
            $table->timestamps();

            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('product_id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }


};