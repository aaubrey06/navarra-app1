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
        Schema::dropIfExists('orders');

        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->foreignId('customer_id')->constrained('customer', 'customer_id')->onDelete('cascade');
            $table->foreignId('order_status_id')->constrained('order_status', 'order_status_id')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products', 'product_id')->onDelete('cascade');
            $table->date('order_date');
            $table->string('rice_type');
            $table->integer('quantity')->default(0);
            $table->string('method', 25);
            $table->string('tracking_no');
            $table->date('delivery_date')->nullable();
            $table->string('payment_status');
            $table->string('location')->nullable();
            $table->timestamps();
        });
        
    }
    protected $primaryKey = 'order_id'; 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
