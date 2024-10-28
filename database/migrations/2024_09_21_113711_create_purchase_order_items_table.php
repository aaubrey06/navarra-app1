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
            $table->id(); // Primary key
            $table->foreignId('purchase_order_id')->constrained()->onDelete('cascade'); // Foreign key referencing purchase orders
            $table->foreignId('product_id')->constrained('products', 'product_id'); // Foreign key referencing products
            $table->integer('quantity'); // Quantity of the product ordered
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
