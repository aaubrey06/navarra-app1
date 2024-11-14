<?php

// StockRequestNotification.php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class StockRequestNotification extends Notification
{
    use Queueable;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
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
            'request_id' => $this->data['request_id'],
            'product_id' => $this->data['product'],
            'status_id' => $this->data['status'],
            'recipient_role' => $this->data['warehouse_manager'],
        ];
    }
}
