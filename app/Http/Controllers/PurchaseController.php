<?php

namespace App\Http\Controllers;

use App\Models\Product; 
use App\Models\PurchaseOrder; // Updated to use the new model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index()
    {
        // Fetch all purchase orders and products from the database
        $purchaseOrders = PurchaseOrder::all(); // Updated model reference
        $products = Product::all();

        // Pass both purchaseOrders and products to the view
        return view('store_manager.purchase_stock.index', compact('purchaseOrders', 'products'));
    }

    public function create()
    {
        $products = Product::all();
        return view('store_manager.purchase_stock.create', compact('products'));
    }

    /**
     * Store a newly created stock request in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'total_amount' => 'required|numeric|min:0',
        ]);
        

        // Create a new purchase order
        $purchaseOrder = PurchaseOrder::create([
            'supplier_name' => $validated['supplier_name'],
            'rice_type' => $validated['product_id'], // Assuming 'rice_type' refers to product_id
            'quantity' => $validated['quantity'],
            'total_amount' => $validated['total_amount'],
            'status' => 'pending', 
        ]);

        // Redirect with a success message
        return redirect()->route('store_manager.purchase_stock.index')
            ->with('success', 'Stock request has been submitted successfully.');
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

        // Insert data directly into the 'purchases' table
        DB::table('purchases')->insert([
            'supplier_name' => $request->supplier_name,
            'product_id' => $request->product,
            'quantity' => $request->quantity,
            'total_price' => $request->total_price,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect with a success message
        return redirect()->route('store_manager.purchase_stock.index')->with('success', 'Purchase recorded successfully.');
    }

    // Owner side method for managing stock
    public function stock()
    {
        // Fetch products to populate the dropdown in the view
        $products = Product::all();
        return view('owner.purchase_stock.index', compact('products'));
    }
}
