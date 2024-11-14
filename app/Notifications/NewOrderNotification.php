<?php

// Newordernotification.php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
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
            'order_id' => $this->data['order_id'],
            'recipient_role' => $this->data['driver'],
        ];
    }
}
