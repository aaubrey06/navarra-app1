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
}
