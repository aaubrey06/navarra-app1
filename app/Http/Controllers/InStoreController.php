<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\OrderStore;
class InStoreController extends Controller
{
    public function index()
    {
        $orderstore = OrderStore::with('product')->get();
        return view('store_manager.in-store-orders.index', compact('orderstore'));
    }

    public function create()
    {
        $products = Product::all();
        return view('store_manager.in-store-orders.create', compact('products'));
    }

    public function store(Request $request)
{
    // Validate the incoming request
    $validated = $request->validate([
        'customer_name' => 'required|string|max:255',
        'phone_number' => 'required|string|max:15',
        'product_id' => 'required|exists:products,product_id', // Ensure the product exists
        'quantity' => 'required|integer|min:1',
        'unit' => 'required|string|in:kg,sack',
        'price' => 'required|numeric',
        'method' => 'required|string|in:pickup,delivery',
        'location' => 'nullable|string|max:255',
        'order_date' => 'required|date',
    ]);

    // Create the order
    $order = new OrderStore();
    $order->customer_name = $validated['customer_name'];
    $order->phone_number = $validated['phone_number'];
    $order->product_id = $validated['product_id'];
    $order->quantity = $validated['quantity'];
    $order->unit = $validated['unit'];
    $order->price = $validated['price'];
    $order->method = $validated['method'];
    $order->location = $validated['location'];
    $order->order_date = $validated['order_date'];
    $order->order_status = 'pending'; // Set the default status to 'pending'
    $order->save();

    // Find the product and decrease its current quantity by the ordered quantity
    $product = Product::findOrFail($validated['product_id']);
    $product->current_quantity -= $validated['quantity'];
    $product->save();

    return redirect()->route('store_manager.in-store-orders.index')
                     ->with('success', 'Order created successfully and product quantity updated.');
}

    public function edit($order_id)
    {
    $order = OrderStore::findOrFail($order_id);
    $products = Product::all(); 
    return view('store_manager.in-store-orders.edit', compact('order', 'products'));
    }
    public function update(Request $request, $order_id)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'product_id' => 'required|exists:products,product_id',
            'quantity' => 'required|numeric|min:1',
            'unit' => 'required|in:kg,sack',
            'price' => 'required|numeric|min:0',
            'method' => 'required|in:pickup,delivery',
            'order_date' => 'required|date',
            'location' => 'nullable|string|max:255', // Location is optional for pickup orders
        ]);
    
        $order = OrderStore::findOrFail($order_id);
        $order->update([
            'customer_name' => $request->customer_name,
            'phone_number' => $request->phone_number,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'price' => $request->price,
            'method' => $request->method,
            'location' => $request->location,
            'order_date' => $request->order_date,
            'order_status' => 'pending',
        ]);
    
        return redirect()->route('store_manager.in-store-orders.index')->with('success', 'Order updated successfully!');
    }
    
    public function destroy($order_id)
    {
    $order = OrderStore::findOrFail($order_id);
    $order->delete();

    return redirect()->route('store_manager.in-store-orders.index')->with('success', 'Order deleted successfully!');
    }

    public function updateStatus(Request $request, $order_id)
{
    $order = OrderStore::findOrFail($order_id);
    
    $validated = $request->validate([
        'order_status' => 'required|in:pending,shipped,delivered',
    ]);
    
    if (!isset($validated['order_status'])) {
        $validated['order_status'] = 'pending';
    }

    $order->order_status = $validated['order_status'];
    $order->save();

    return redirect()->route('store_manager.in-store-orders.index')
                     ->with('success', 'Order status updated successfully.');
}

    

}
