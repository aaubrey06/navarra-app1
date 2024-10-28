<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class OrderDeliveredNotification extends Notification
{
    use Queueable;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    // Send notification via broadcast
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'message' => 'Your order has been shipped!'
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'order_id' => $this->order->id,
            'message' => 'Your order has been shipped!'
        ]);
    }
}

