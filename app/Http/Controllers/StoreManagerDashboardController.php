<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Sale;

class StoreManagerDashboardController extends Controller
{
    public function index(Request $request)
    {
        $orderstoreSales = DB::table('orderstore')->sum('price');
        $salesTableSales = Sale::sum('total_price');
        $totalSales = $orderstoreSales + $salesTableSales;
    
        $orderstoreOrdersCount = DB::table('orderstore')->count();
        $salesTableOrdersCount = Sale::count();
        $totalOrders = $orderstoreOrdersCount + $salesTableOrdersCount;
    
        return view('store_manager.store-manager-dashboard', compact('totalSales', 'totalOrders', 'orderstoreOrdersCount', 'salesTableOrdersCount'));
    }

    public function indexowner(Request $request)
    {
        $orderstoreSales = DB::table('orderstore')->sum('price');
        $salesTableSales = Sale::sum('total_price');
        $totalSales = $orderstoreSales + $salesTableSales;
    
        $orderstoreOrdersCount = DB::table('orderstore')->count();
        $salesTableOrdersCount = Sale::count();
        $totalOrders = $orderstoreOrdersCount + $salesTableOrdersCount;
    
        return view('owner.owner-dashboard', compact('totalSales', 'totalOrders', 'orderstoreOrdersCount', 'salesTableOrdersCount'));
    }


}