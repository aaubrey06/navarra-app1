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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id('purchase_order_id'); // Primary key
            $table->string('supplier_name'); // Supplier name
            $table->string('rice_type'); // Type of rice
            $table->decimal('quantity', 10, 2); // Quantity of rice ordered
            $table->decimal('total_amount', 10, 2)->nullable(); // Total amount of the purchase order (Quantity * Unit Price)
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending'); // Status of the purchase order
            $table->timestamps(); // created_at and updated_at fields
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
