<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
        return view('customer.order-list');
    }

    public function history(): View
    {
        return view('customer.history');
    }

    public function products(): View
    {
        $products = Product::all(); // Fetch all products
        //dd($products);
        return view('customer.customer-dashboard', compact('products')); // Pass products to the view
    }

}
