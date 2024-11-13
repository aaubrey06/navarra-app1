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
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Use UUID as the primary key
            $table->morphs('notifiable'); // This adds notifiable_id and notifiable_type
            $table->string('type'); // The notification type (the class name of the notification)
            $table->text('data'); // The actual notification data (JSON encoded)
            $table->timestamp('read_at')->nullable(); // When the notification was read
            $table->timestamps(); // created_at and updated_at
            $table->string('recipient_role')->nullable(); // Store recipient role
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
