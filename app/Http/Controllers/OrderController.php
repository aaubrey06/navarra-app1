<?php

namespace App\Http\Controllers;

use App\Notifications\OrderShippedNotification;

public function shipOrder($orderId)
{
    $order = Order::find($orderId);
    $user = User::find($order->user_id);

    // Notify the user
    $user->notify(new OrderShippedNotification($order));

    return response()->json(['status' => 'Order shipped and notification sent']);
}
