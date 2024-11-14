<?php

namespace App\Http\Controllers; // Make sure the controller has the correct namespace

use App\Models\Order;  // Make sure the Order model is imported
use App\Models\User;
use App\Notifications\NewOrderNotification;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller  // Ensure the method is inside a controller class
{
    // Method to assign the order to a driver and notify
    public function assignOrderToDriver($order_id)
    {
        // Fetch the order and driver
        $order = Order::findOrFail($order_id); // Find the order by ID using the correct variable $order_id
        $driver = User::where('role', 'driver')->first(); // Get the assigned driver (ensure this is correct based on your logic)

        // Send notification to driver
        if ($driver) {
            // Send the notification to the driver
            $driver->notify(new NewOrderNotification($order));  // Notify the driver

            return response()->json([
                'message' => 'New order notification sent to driver successfully.',
                'order' => $order
            ]);
        }

        return response()->json(['error' => 'No driver found to assign this order.'], 404);
    }
}
