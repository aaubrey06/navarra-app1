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
        Schema::create('stores', function (Blueprint $table) {
            $table->id('store_id');
            $table->string(column: 'store_name', length: 45);
            $table->string(column: 'store_location', length: 45);
            $table->string('store_longitude', length: 45);
            $table->string('store_latitude', length: 45);
            $table->string('contact', 15)->nullable(); 
            $table->string('working_hours', 50)->nullable();
            $table->enum('status', ['open', 'closed'])->default('open');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
