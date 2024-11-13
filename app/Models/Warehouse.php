<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $table = 'warehouse_stocks';

    protected $primaryKey = 'warehouse_stocks_id';

    protected $fillable = [
        'product_id',
        'arrival_date',
        'unit',
        'batch_code',
        'product_code',
        'quantity',
        'supplier',
        'qr_code',
    ];

    protected static function boot()
    {
        parent::boot();

        // Prevent saving a record with negative quantity
        static::saving(function ($model) {
            if ($model->quantity <= 0) {
                throw new \Exception('Quantity cannot be negative.');
            }
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
