<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class StockController extends Controller
{
    public function index()
    {
     
        $products = Product::all(); 
    
      
        return view('store_manager.stocks.index', compact('products'));
    }

    public function create()
    {
        $products = Product::all(); 
         
        return view('store_manager.stocks.create', compact('products'));
        
    }

    public function store(Request $request)
{
    // Validate the form input
    $request->validate([
        'product_id' => 'required|exists:products,product_id',
        'current_quantity' => 'required|integer|min:1',
    ]);

    $product = Product::find($request->product_id);

    if ($product) {
        $product->current_quantity += $request->current_quantity;
                $product->save();

        return redirect()->route('store_manager.stocks.index')->with('success', 'Stock added successfully!');
    } else {
        return redirect()->route('store_manager.stocks.index')->with('error', 'Product not found.');
    }
}


    
    
}
