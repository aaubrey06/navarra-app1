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
        Schema::create('warehouse_stocks', function (Blueprint $table) {
            $table->id('warehouse_stocks_id');
            $table->foreignId('product_id');
            $table->string('unit');
            $table->date('arrival_date');
            $table->string('batch_code', length: 45);
            $table->string('product_code', length: 45);
            $table->integer('quantity');
            $table->string('qr_code', length: 45);
            $table->string('supplier', length: 45);
            $table->foreignId('invtype_id');
            $table->foreignId('warehouse_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_stocks');
    }
};
