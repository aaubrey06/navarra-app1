<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
    use Queueable;

    protected $orderStore;

    // Constructor now accepts order data instead of stock request data
    public function __construct($orderStore)
    {
        $this->orderStore = $orderStore;
    }

    // Define the delivery channels
    public function via($notifiable)
    {
        return ['database']; // We're saving the notification to the database
    }

    // Define the data to store in the database
    public function toArray($notifiable)
    {
        return [
            'orderstore_ids' => $this->orderStore->pluck('id')->toArray(),  // Get the order IDs
            'message' => 'You have new in-store orders pending.', // Custom message
            'orderstore_status' => $this->orderStore->pluck('status')->toArray(),  // Get order statuses (optional)
            'recipient_role' => 'driver', // Assuming this notification is for drivers
        ];
    }
}
