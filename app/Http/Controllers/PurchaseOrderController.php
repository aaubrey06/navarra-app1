<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PurchaseOrderController extends Controller
{


    public function index(): View
    {
        $purchaseOrders = PurchaseOrder::with('store')->get();
        return view('store_manager.purchase_order.index', compact('purchaseOrders'));
    }
    
    public function create(): View
    {
        $products = Product::all();
        $store = auth()->user()->store;
        return view('purchase_orders.create', compact('products', 'store'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        // Create the purchase order
        $purchaseOrder = new PurchaseOrder();
        $purchaseOrder->order_number = 'PO-' . strtoupper(uniqid()); // Automated order number
        $purchaseOrder->store_id = auth()->user()->store_id;
        $purchaseOrder->save();

        // Attach items to the purchase order
        foreach ($request->products as $productId => $productData) {
            PurchaseOrderItem::create([
                'purchase_order_id' => $purchaseOrder->id,
                'product_id' => $productId,
                'quantity' => $productData['quantity'],
            ]);
        }

        return redirect()->route('purchase_orders.index')->with('success', 'Purchase order created successfully.');
    }
}
