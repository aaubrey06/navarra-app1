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
        Schema::create('customer', function (Blueprint $table) {
            // $table->id('customer_id');
            // $table->foreignId('id');
            // $table->string('c_address', length: 45);
            // $table->string('c_longitude', length: 45);
            // $table->string('c_latitude', length: 45);
            $table->id('customer_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key
            $table->string('phone', 15);
            $table->string('region', 100);
            $table->string('province', 100);
            $table->string('city', 100);
            $table->string('barangay', 100);
            $table->string('address')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
