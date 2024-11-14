<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Order;
use App\Models\Delivery;

class DeliveryController extends Controller
{
    
    // public function index(): View
    // {
    //     return view('store_manager.delivery.index');
    // }

    
    public function index(): View
    {
        $deliveries = Delivery::with(['driver', 'vehicle', 'order', 'deliveryStatus'])->get();
        dd($deliveries);  // This will dump the deliveries to the browser
        return view('store_manager.delivery.index', compact('deliveries'));
    }
    


    
    public function showdelivery(): View
    {
        $orders = Order::with('user')->get(); 

        return view('owner.delivery.delivery', compact('orders'));   
    }
}
