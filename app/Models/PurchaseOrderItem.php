<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    use HasFactory;
    public function store() {
        return $this->belongsTo(store::class);
    }

    public function items() {
        return $this->hasMany(PurchaseOrderItem::class);
    }
}
