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
        Schema::create('employees', function (Blueprint $table) {
        $table->id('employee_id');
        $table->string('name');
        $table->string('position');
        $table->string('gender')->nullable(); 
        $table->date('dob')->nullable(); 
        $table->string('email')->unique(); 
        $table->string('phone_number')->nullable(); 
        $table->string('address')->nullable(); 
        $table->string('city')->nullable(); 
        $table->string('province')->nullable(); 
        $table->string('region')->nullable(); 
        $table->string('postal_code')->nullable(); 
        $table->string('nationality')->nullable(); 
        $table->string('ssn')->nullable(); 
        $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
