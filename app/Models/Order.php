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
        'delivery_option',
    ];

    // protected $casts = [
    //     'latitude' => 'decimal:8',
    //     'longitude' => 'decimal:8',
    // ];

    public $timestamps = true;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }

    public function scopeDelivered($query)
    {
        return $query->where('order_status_id', 'Delivered');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id');
    }




}
