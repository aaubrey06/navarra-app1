<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('successhistory', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('order_id'); // Reference to the related order
        $table->binary('image'); // Field to store the image as BLOB
        $table->dateTime('delivered_at'); // Date and time of successful delivery
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('successhistory');
    }
};
