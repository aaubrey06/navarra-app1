<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'tracking_no',
        'delivery_date',
        'payment_status',
        'order_status',
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }

    // Define a scope to filter orders by status
    public function scopeDelivered($query)
    {
        return $query->where('order_status', 'Delivered');
    }

}
