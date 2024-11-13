<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Product; 
class WalkinController extends Controller
{
    
    public function index(): View
    {
        
        $products = Product::all();
        
       
        return view('store_manager.walk-in.index', compact('products'));
    }

    
    public function submit(Request $request)
    {
       
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'product' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric'
        ]);

        // Process the POS transaction
        // Here you could save the data to a 'transactions' table, for example
        // Transaction::create($validatedData); // Assuming a Transaction model

        // Redirect back to the POS form with a success message
        return redirect()->route('store_manager.pos')->with('success', 'Order processed successfully!');
    }
}
