<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuccessHistory extends Model
{
    use HasFactory;
    public function order()
{
    return $this->belongsTo(Order::class);
}
public static function createSuccessHistory($orderId, $request)
{
    self::create([
        'order_id' => $orderId,
        'delivered_at' => now(),
        'image' => file_get_contents($request->file('image')->getRealPath()), // Convert image to binary format
    ]);
}

}
