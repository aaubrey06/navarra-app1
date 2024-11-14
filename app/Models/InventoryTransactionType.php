<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryTransactionType extends Model
{
    use HasFactory;

    // Set the primary key for the table
    protected $primaryKey = 'invtype_id';

    // Disable auto-incrementing if 'invtype_id' is not an integer
    public $incrementing = true; // Set to false if 'invtype_id' is non-numeric

    // Specify the data type of the primary key
    protected $keyType = 'int'; // Use 'string' if it's non-numeric

    // Specify the table associated with this model (optional if using default conventions)
    protected $table = 'inventory_transaction_type';

    // Allow mass-assignment on the following columns
    protected $fillable = ['inventoryt_type'];

    // Optionally, you can disable timestamps if not using `created_at` and `updated_at`
    public $timestamps = false;
}
