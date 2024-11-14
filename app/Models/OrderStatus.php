<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    protected $table = 'orderstatus';

    protected $fillable = [
        'order_id',
        'status',
        'reason',
    ];
}
