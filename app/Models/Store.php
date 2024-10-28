<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'location'];

    // A store can have many purchase orders
    public function purchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }
}
