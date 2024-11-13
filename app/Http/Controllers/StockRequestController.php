<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockRequest;
use App\Models\Store;
use App\Models\User;
use App\Notifications\StockRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StockRequestController extends Controller
{
    public function getAllStockRequest()
    {
        $warehouse_stocks = [];
        $store = Store::all();
        $products = Product::all();
        $requests = StockRequest::all();
        $stock_requests = [];
        foreach ($products as $key => $product) {
            $product_total = DB::table('warehouse_stocks')->where('product_id', '=', $product->product_id)->sum('quantity');
            $warehouse_stocks[$key]['product_id'] = $product->product_id;
            $warehouse_stocks[$key]['product_name'] = $product->rice_type;
            $warehouse_stocks[$key]['quantity'] = $product_total;

        }
        foreach ($requests as $key => $request) {
            $stock_requests['request_number'] = $request->request_id;
            $stock_requests['order_date'] = $request->created_at;
            $stores = DB::table('stores')->where('store_id', '=', $request->store_id)->first();
            $stock_requests['store_name'] = $stores;
            $product = DB::table('products')->where('product_id', '=', $request->product_id)->first();
            $stock_requests['product'] = $product;
            $stock_requests['unit'] = $request->unit;
            $stock_requests['quantity'] = $request->quantity;
            $stock_requests['delivery_date'] = '';
            $stock_requests['status'] = $request->status;
        }

        return view('store_manager.inventory.stockrequest', ['requests' => $requests, 'products' => $products, 'stores' => $store, 'warehouse_stocks' => $warehouse_stocks]);
    }

    public function addStock(Request $request)
    {
        // Fetch the available stock for the requested product
        $product = Product::find($request->product);
        $available_stock = DB::table('warehouse_stocks')
            ->where('product_id', '=', $product->product_id)
            ->sum('quantity');

        // Check if available stock is sufficient
        if ($available_stock == 0 || $request->quantity > $available_stock) {
            // Redirect back with error if stock is insufficient
            return redirect()->back()->with('error', 'Insufficient stock available. Available stock: '.$available_stock);
        }

        $data = new StockRequest;
        $data->product_id = $request->product;
        $data->store_id = $request->store_name;
        $data->quantity_requested = $request->quantity;
        $data->unit = $request->unit;
        $data->status = 'Pending';
        $data->save();

        // Send notification to warehouse_manager (or other relevant users)
        $warehouseManager = User::where('role', 'warehouse_manager')->first(); // Assuming you're sending to the warehouse manager

        if ($warehouseManager) {
            $warehouseManager->notify(new StockRequestNotification($data)); // Trigger the notification

            \DB::table('notifications')->insert([
                'id' => (string) Str::uuid(), // Generate a unique UUID for the notification
                'notifiable_type' => get_class($warehouseManager),
                'notifiable_id' => $warehouseManager->id,
                'type' => 'App\\Notifications\\StockRequestNotification', // Notification class type
                'data' => json_encode(['message' => 'Stock request pending.', 'stock_request_id' => $data->id]),
                'recipient_role' => 'warehouse_manager', // Set the recipient role
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->back()->with('success', 'Stock Requested successfully.');

            // return redirect()->back()->with('success', 'Stock Requested successfully.');
        }
    }
}
