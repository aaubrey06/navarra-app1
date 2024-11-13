<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;use Illuminate\Support\Facades\DB;

class WarehousestockController extends Controller
{
    public function index(): View
    {
        $warehouse_stocks = DB::table('warehouse_stocks')->get();
    $products = DB::table('products')->get();
    
    // Prepare data to pass to the view
    return view('store_manager.warehouse_stock.index', [
        'warehouse_stocks' => $warehouse_stocks,
        'products' => $products,
    ]);
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
