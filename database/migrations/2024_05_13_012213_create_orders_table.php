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
        // Schema::create('order', function (Blueprint $table) {
        //     $table->id('order_id');
        //     $table->foreignId('customer_id');
        //     $table->date('order_date');
        //     $table->string('method', length: 25);//Ano ang method???
        //     $table->foreignId('order_status_id');
        // });

        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->string('tracking_no');
            $table->date('delivery_date');
            $table->string('payment_status');
            $table->string('order_status');
            $table->string('delivery_option');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
