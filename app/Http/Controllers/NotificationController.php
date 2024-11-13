<?php

namespace App\Http\Controllers;

use App\Models\Notification;

class NotificationController extends Controller
{
    // Show the list of notifications.
    public function index()
    {
        // Fetch unread or pending notifications from the database
        $notifications = Notification::where('status', 'pending')  // Adjust 'pending' to your status as needed
            ->orderBy('created_at', 'desc')  // Orders by `created_at` in descending order
            ->orderBy('updated_at', 'desc')  // Orders by `updated_at` in descending order, as a secondary sort
            ->get();  // Fetch all notifications

        // // Pass notifications to the view along with the unread count
        // $unreadNotificationsCount = $notifications->where('status', 'pending')->count();

        return view('layouts.app', compact('notifications'));
    }
}

// namespace App\Http\Controllers;

// use App\Models\Notification;  // Ensure the Notification model is imported

// class NotificationController extends Controller
// {
//     /**
//      * Show the list of notifications.
//      *
//      * @return \Illuminate\View\View
//      */
//     public function index()
//     {
//         // Fetch unread or pending notifications from the database
//         $notifications = Notification::where('status', 'pending')  // Adjust 'pending' to your status as needed
//             ->orderBy('created_at', 'desc') // Orders by the most recent notifications
//             ->get();  // Fetch all notifications

//         // Pass notifications to the view
//         return view('layouts.app', compact('notifications'));
//     }
// } -->
