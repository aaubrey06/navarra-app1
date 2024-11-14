<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Notification extends Model
{
    // Disable auto-incrementing because we will use UUID
    public $incrementing = false;

    // Set the key type to 'string' because UUIDs are stored as strings
    protected $keyType = 'string';

    // Automatically generate a UUID for the id field when creating a notification
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($notification) {
            $notification->id = (string) Str::uuid(); // Generate a UUID for the id field
        });
    }

    // If you want to use mass assignment, you can define $fillable or $guarded
    // protected $fillable = ['notifiable_id', 'notifiable_type', 'type', 'data', 'read_at'];
}
