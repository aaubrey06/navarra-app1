<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStore extends Model
{
    protected $table = 'orderstore';
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'customer_name',
        'phone_number',
        'product_id',
        'quantity',
        'unit',
        'price',
        'method',
        'location',
        'order_date',
        'order_status', 
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

   
    public function getFormattedPriceAttribute()
    {
        return '₱' . number_format($this->price, 2);
    }

    public function successHistories()
    {
        return $this->hasMany(SuccessHistory::class);
    }

    public function failedHistories()
    {
        return $this->hasMany(FailedHistory::class);
    }

    public function confirmDelivery($orderId)
{
    // Find the order by ID
    $order = InStoreOrder::find($orderId);

    // If the order doesn't exist, return a failure response
    if (!$order) {
        return response()->json(['message' => 'Order not found'], 404);
    }

    // If the delivery is successful
    if ($order->status === 'delivered') {
        // Record the success in SuccessHistory
        SuccessHistory::create([
            'order_id' => $order->id,
            'delivered_at' => now(),  // Time when delivery was confirmed
        ]);

        return response()->json(['message' => 'Delivery confirmed successfully']);
    }

    // If the delivery failed
    if ($order->status === 'failed') {
        // Record the failure in FailedHistory
        FailedHistory::create([
            'order_id' => $order->id,
            'failed_at' => now(),  // Time when delivery failed
            'failure_reason' => 'Delivery failed reason goes here',  // Add a reason if necessary
        ]);

        return response()->json(['message' => 'Delivery failed']);
    }

    // If the status is neither 'delivered' nor 'failed'
    return response()->json(['message' => 'Invalid order status'], 400);
}
}
