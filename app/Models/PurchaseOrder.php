<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number', // The unique order number
        'store_id',     // The foreign key for the store
        'total_amount', // Total amount of the purchase order
        'status',       // Status of the purchase order
        'notes',        // Notes about the purchase order
        'created_at',   // Timestamp for when the order was created
        'updated_at',   // Timestamp for when the order was last updated
    ];
    
    public function store() {
        return $this->belongsTo(Store::class);
    }

    public function items() {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    
}
