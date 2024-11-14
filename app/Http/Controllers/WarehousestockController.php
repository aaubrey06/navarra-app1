<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;use Illuminate\Support\Facades\DB;
use App\Models\WarehouseStock;
use App\Models\Product;


class WarehousestockController extends Controller
{
    public function index(): View
    {
        $warehouseStocks = WarehouseStock::all();
        $products = Product::all(); 
    
        return view('store_manager.warehouse_stock.index', compact('warehouseStocks', 'products'));
    }

    public function showstock(): View
    {
        $warehouse_stocks = DB::table('warehouse_stocks')->get();
    $products = DB::table('products')->get();
    
    // Prepare data to pass to the view
    return view('owner.warehouse_stock.index', [
        'warehouse_stocks' => $warehouse_stocks,
        'products' => $products,
    ]);
    }
}
