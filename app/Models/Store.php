<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $table = 'stores';

    protected $primaryKey = 'store_id';

    protected $fillable = [
        'store_name',
        'store_location',
        'store_latitude',
        'store_longitude',
        'contact',
        'working_hours',
        'status',
    ];

    // public function purchaseOrders()
    // {
    //     return $this->hasMany(PurchaseOrder::class);
    // }
}
