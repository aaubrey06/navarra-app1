<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrders extends Model
{
    use HasFactory;

    protected $table = 'purchase_orders';

    protected $primaryKey = 'purchase_order_id';

    protected $fillable = [
        'supplier_name',
        'rice_type',
        'quantity',
        'total_amount',
        'status',
    ];
   

    protected $casts = [
        'quantity' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    public function purchaseOrderItems()
    {
        return $this->hasMany(PurchaseOrderItem::class, 'purchase_order_id');
    }
}
