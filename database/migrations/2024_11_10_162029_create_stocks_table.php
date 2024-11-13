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

        // Schema::create('purchase_order_status', function (Blueprint $table) {
        //     $table->id('po_status_id');
        //     $table->string('po_status', length: 25);

        // });

        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->references(column: 'product_id')->on('products');
            $table->integer('current_quantity')->default(0); 
            $table->timestamps(); 

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('purchase_order_status');

        Schema::dropIfExists('stocks');

    }
};
