<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SalesController extends Controller
{
    public function index(Request $request)
    {

       $sales = Sale::sum('total_price');
    return view('store_manager.sales.index', compact('sales'));
   
    
        // // Sample data for sales
        // $overallSales = 5000;
        // $overallOrders = 150;
        // $instoreSales = 2000;
        // $instoreOrders = 60;
        // $onlineSales = 1500;
        // $onlineOrders = 50;
        // $walkinSales = 1500;
        // $walkinOrders = 40;
    
        // // Default sales type
        // $salesType = $request->input('sales_type', 'all');
    
        // // Pass data to the view based on the selected filter
        // return view('store_manager.sales.index', compact(
        //     'salesType',
        //     'overallSales',
        //     'overallOrders',
        //     'instoreSales',
        //     'instoreOrders',
        //     'onlineSales',
        //     'onlineOrders',
        //     'walkinSales',
        //     'walkinOrders'
        // ));
    }

    public function sales(Request $request)
    {
        // Sample data for sales
        $overallSales = 5000;
        $overallOrders = 150;
        $instoreSales = 2000;
        $instoreOrders = 60;
        $onlineSales = 1500;
        $onlineOrders = 50;
        $walkinSales = 1500;
        $walkinOrders = 40;
    
        // Default sales type
        $salesType = $request->input('sales_type', 'all');
    
        // Pass data to the view based on the selected filter
        return view('owner.sales.sales', compact(
            'salesType',
            'overallSales',
            'overallOrders',
            'instoreSales',
            'instoreOrders',
            'onlineSales',
            'onlineOrders',
            'walkinSales',
            'walkinOrders'
        ));
    }
    public function storeWalkInSale(Request $request)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,product_id', // Ensure product exists
            'quantity_sold' => 'required|integer|min:1', // Ensure quantity_sold is a positive integer
        ]);
    
        // Log the validated data to see if it's correct
        Log::debug('Validated data: ', $validatedData);
    
        // Retrieve the selected product from the database
        $product = Product::find($validatedData['product_id']);
    
        // Log the product data to verify it's being fetched correctly
        Log::debug('Product Data: ', $product ? $product->toArray() : 'Product not found');
    
        if (!$product) {
            return redirect()->back()->withErrors(['product_id' => 'Product not found.']);
        }
    
        if ($product->current_quantity < $validatedData['quantity_sold']) {
            return redirect()->back()->withErrors(['quantity_sold' => 'Not enough stock available']);
        }
    
        // Calculate the total price (selling_price * quantity sold)
        $totalPrice = $product->selling_price * $validatedData['quantity_sold'];
    
        // Begin a database transaction
        DB::beginTransaction();
    
        try {
            // Decrease the product quantity by the sold amount
            $product->current_quantity -= $validatedData['quantity_sold'];
            $product->save(); // Save the updated product
    
            // Log before creating the sale to ensure everything is ready
            Log::debug('Creating sale with data: ', [
                'product_id' => $product->product_id,
                'quantity_sold' => $validatedData['quantity_sold'],
                'total_price' => $totalPrice,
                'sale_date' => now(),
            ]);
    
            // Create a new sale record
            Sale::create([
                'product_id' => $product->product_id,
                'quantity_sold' => $validatedData['quantity_sold'],
                'total_price' => $totalPrice,
                'sale_date' => now(),
            ]);
    
            // Commit the transaction
            DB::commit();
    
            return redirect()->route('store_manager.walk-in.index')->with('success', 'Sale recorded successfully!');
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();
    
            // Log the exception
            Log::error('Error during sale creation: ' . $e->getMessage());
    
            return redirect()->back()->withErrors(['sale' => 'Failed to record the sale.']);
        }
    }
    
    
}
