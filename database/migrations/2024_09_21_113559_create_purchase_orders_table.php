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
            $table->id(); // Primary key
            $table->string('order_number')->unique(); // Unique order number
            $table->foreignId('store_id')->constrained('store', 'store_id'); // Foreign key referencing the stores table
            $table->decimal('total_amount', 10, 2)->nullable(); // Total amount of the purchase order
            $table->string('status')->default('pending'); // Status of the purchase order (e.g., pending, completed)
            $table->text('notes')->nullable(); // Optional notes about the purchase order
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
