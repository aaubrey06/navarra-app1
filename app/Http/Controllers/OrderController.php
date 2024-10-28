<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\View\View;


class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::with('products')->get();
        return view ('store_manager.orders.index', compact('orders'));
    }

    public function show($id): View
    {
        $order = Order::with('products')->find($id);
        return view('store_manager.order.show', compact('order'));
    }
}
