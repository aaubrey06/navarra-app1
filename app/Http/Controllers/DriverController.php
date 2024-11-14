<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class DriverController extends Controller
{
    public function view()
    {
        return view('driver.routes');
    }

    public function orders()
    {
        return view('driver.orders');
    }

    public function schedule()
    {
        return view('driver.schedule');
    }


    public function getOrders()
{
    // Retrieve the in-store orders (you may need to adjust the query based on your database schema)
    $orders = Order::where('status', 'pending') // Example filter
        ->select('order_id', 'order_date', 'customer_name', 'rice_type', 'quantity', 'price', 'location', 'order_status')
        ->get();

    // Return the orders as a JSON response
    return response()->json($orders);
}

public function showRoutes()
{
    $orders = Order::all(); // Replace with the logic to fetch today's scheduled orders
    return view('driver.routes', compact('orders'));
}



}