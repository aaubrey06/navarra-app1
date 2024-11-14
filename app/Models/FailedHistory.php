<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedHistory extends Model
{
    use HasFactory;
    // In FailedHistory.php
public function order()
{
    return $this->belongsTo(Order::class);
}
public static function logFailure($orderId)
{
    FailedHistory::create([
        'order_id' => $orderId,
        'failed_at' => now(),
        'failure_reason' => 'Customer unavailable',
    ]);
}
}
