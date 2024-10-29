<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockRequest;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

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
        $data = new StockRequest;
        $data->product_id = $request->product;
        $data->store_id = $request->branchName;
        $data->quantity_requested = $request->quantity;
        $data->unit = $request->unit;
        $data->status = 'pending';
        $data->save();

        return redirect()->back()->with('success', 'Stock Requested successfully.');
    }
}
