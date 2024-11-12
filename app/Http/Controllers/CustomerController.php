<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function view(): View
    {
        return view('customer.cart');
    }

    public function orders(): View
    {
        $orders = Order::whereNotIn('status', ['Delivered', 'Cancelled'])
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('customer.order-list', compact('orders'));
    }

    public function history(): View
    {
        $orders = Order::orderBy('created_at', 'desc')
                        ->get();
        return view('customer.history', compact('orders'));
    }

    public function products(): View
    {
        $products = Product::all(); // Fetch all products
        //dd($products);
        return view('customer.customer-dashboard', compact('products')); // Pass products to the view
    }

}
