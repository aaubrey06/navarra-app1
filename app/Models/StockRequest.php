<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockRequest extends Model
{
    use HasFactory;

    protected $primaryKey = 'request_id';

    protected $fillable = [
        'store_id',
        'product_id',
        'quantity_requested',
        'status',
    ];

    /**
     * Get the store that owns the stock request.
     */
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'store_id');
    }

    /**
     * Get the product associated with the stock request.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
