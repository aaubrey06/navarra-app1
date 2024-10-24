<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Models\WarehouseHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class WarehouseManagerController extends Controller
{
    public function dashboard(): View
    {
        $user = Auth::user();

        return view('warehouse_manager.warehouse-manager-dashboard');
    }

    public function generateQR(): View
    {
        $products = DB::table('products')->get();

        return view('warehouse_manager.generate-qr', ['products' => $products]);
    }

    public function qrScan(): View
    {
        return view('warehouse_manager.qrScan');
    }

    public function purchase_req(): View
    {
        return view('warehouse_manager.purchase_req');
    }

    public function foroutbound(Request $request): View
    {

        $warehouse_stocks_id = $request->qrCode;
        $warehouse_stock = DB::table('warehouse_stocks')->where('qr_code', '=', $request->qrCode)->get();

        $products = DB::table('products')->where('product_id', '=', $warehouse_stock[0]->product_id)->get();
        $data = ['products' => $products, 'warehouse_stock' => $warehouse_stock];

        return view('warehouse_manager.foroutbound', ['data' => $data]);
    }

    public function outbound_stocks(): View
    {
        $warehouse_stocks = DB::table('warehouse_stocks')->get();
        $warehouse_history = DB::table('warehouse_history')->get();
        $products = DB::table('products')->get();
        $warehouse_data = [
            'warehouse_stocks' => $warehouse_stocks,
            'products' => $products,
            'warehouse_history' => $warehouse_history,
        ];

        return view('warehouse_manager.outbound_stocks', ['warehouse_data' => $warehouse_data]);
    }

    public function create(): View
    {
        return view('warehouse_manager.create');
    }

    public function warehouse(Request $request)
    {
        $warehouse_stocks = DB::table('warehouse_stocks')->get();
        $products = DB::table('products')->get();
        $warehouse_data = [
            'warehouse_stocks' => $warehouse_stocks,
            'products' => $products,
        ];

        return view('warehouse_manager.warehouse', ['warehouse_data' => $warehouse_data]);
    }

    public function add_stocks(Request $request)
    {
        $batch_code = Str::random(10);
        $product_code = Str::upper(Str::random(8));
        $qr_code = $batch_code.$product_code;
        $data = new Warehouse;
        $data->product_id = $request->rice_type;
        $data->unit = $request->unit;
        $data->quantity = $request->quantity;
        $data->arrival_date = $request->arrival_date;
        $data->batch_code = $batch_code;
        $data->product_code = $product_code;
        $data->qr_code = $qr_code;
        $data->invtype_id = '1';
        $data->warehouse_id = '1';

        $data->save();

        return redirect()->back();
    }

    public function sendoutbound(Request $request)
    {
        $warehouse_history = new WarehouseHistory;
        $warehouse_history->warehouse_stocks_id = $request->warehouse_stocks_id;
        $warehouse_history->previous_value = $request->previous_value;
        $warehouse_history->outbound_quantity = $request->outbound_quantity;
        $affected = DB::table('warehouse_stocks')
            ->where('warehouse_stocks_id', $request->warehouse_stocks_id)
            ->update(['quantity' => $request->previous_value - $request->outbound_quantity]);
        $warehouse_history->save();

        return redirect()->route('warehouse');
    }

    // public function update_stocks(Request $request){
    //     $warehouse_stocks_id = $request->rice_type;
    //     return redirect()->route('foroutbound')->with(['warehouse_stocks_id' => $warehouse_stocks_id]);
    // }
    public function categorization(Request $request)
    {
        $warehouse_stocks = DB::table('warehouse_stocks')->get();
        $products = DB::table('products')->get();
        $warehouse_data = [
            'warehouse_stocks' => $warehouse_stocks,
            'products' => $products,
        ];
        $total_per_product = [];
        $percentage_per_product = [];
        $total_quantity = DB::table('warehouse_stocks')->sum('quantity');
        foreach ($products as $key => $product) {
            $product_total = DB::table('warehouse_stocks')->where('product_id', '=', $product->product_id)->sum('quantity');
            $total_per_product[$product->product_id] = $product_total;
            $percentage = ($product_total / $total_quantity) * 100;
            $percentage_per_product[$product->rice_type]['percentage'] = $percentage;
            if ($percentage >= 70) {
                $percentage_per_product[$product->rice_type]['category'] = 'category_a';
            } elseif ($percentage >= 15) {
                $percentage_per_product[$product->rice_type]['category'] = 'category_b';
            } else {
                $percentage_per_product[$product->rice_type]['category'] = 'category_c';
            }
        }

        return view('warehouse_manager.categorization', ['percentage_per_product' => $percentage_per_product]);
    }
}
