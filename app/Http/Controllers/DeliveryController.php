<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Order;

class DeliveryController extends Controller
{
    
    // public function index(): View
    // {
    //     return view('store_manager.delivery.index');
    // }

    
    public function index(): View
    {
        $orders = Order::with('user')->get(); 

        return view('store_manager.delivery.index', compact('orders'));   
    }

    public function showdelivery(): View
    {
        $orders = Order::with('user')->get(); 

        return view('owner.delivery.delivery', compact('orders'));   
    }
}
