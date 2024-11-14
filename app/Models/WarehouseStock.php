<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseStock extends Model
{
    use HasFactory;

    protected $table = 'warehouse_stocks';

    protected $fillable = [
        'product_id',
        'unit',
        'arrival_date',
        'batch_code',
        'product_code',
        'quantity',
        'qr_code',
        'invtype_id',
        'warehouse_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
