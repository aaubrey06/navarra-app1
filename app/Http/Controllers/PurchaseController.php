<?php

namespace App\Http\Controllers;

use App\Models\Product; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index()
    {
        // Fetch products to populate the dropdown in the view
        $products = Product::all();
        return view('store_manager.purchase_stock.index', compact('products'));
    }

    public function submit(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'supplier_name' => 'required|string|max:255',
            'product' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric',
        ]);

        // Assuming you have a Purchase model to handle the purchases
        DB::table('purchases')->insert([
            'supplier_name' => $request->supplier_name,
            'product_id' => $request->product,
            'quantity' => $request->quantity,
            'total_price' => $request->total_price,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect back with a success message
        return redirect()->route('store_manager.purchase_stock.index')->with('success', 'Purchase recorded successfully.');
    }
/// owner side
    public function stock()
    {
        // Fetch products to populate the dropdown in the view
        $products = Product::all();
        return view('owner.purchase_stock.index', compact('products'));
    }
}
