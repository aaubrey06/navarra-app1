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
        Schema::create('purchase_order_items', function (Blueprint $table) {
            $table->id(); // Primary key for purchase order items
            $table->foreignId('purchase_order_id')
                  ->constrained('purchase_orders', 'purchase_order_id') // Reference the 'purchase_order_id' column in 'purchase_orders'
                  ->onDelete('cascade');  // Automatically delete items when the related purchase order is deleted
            $table->foreignId('product_id')
                  ->constrained('products', 'product_id') // Ensure 'product_id' in 'products' is a primary key
                  ->onDelete('cascade');  // Automatically delete items when the related product is deleted
            $table->integer('quantity'); // Quantity of the product in this order
            $table->decimal('unit_price', 10, 2); // Price per unit of the product
            $table->timestamps(); // created_at and updated_at fields
        });
        
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order_items');
    }
};
