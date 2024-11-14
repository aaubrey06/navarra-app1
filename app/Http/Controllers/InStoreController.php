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
        'unit' => 'required|in:5,10,25,50', // Validate the new unit options
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
    $products = Product::all();  // Get all products to populate the product dropdown

    return view('store_manager.in-store-orders.edit', compact('order', 'products'));  // Pass order and products to the view
}


public function update(Request $request, $order_id)
{
    $validated = $request->validate([
        'customer_name' => 'required|string|max:255',
        'phone_number' => 'required|string|max:20',
        'product_id' => 'required|exists:products,product_id',
        'quantity' => 'required|numeric|min:1',
        'unit' => 'required|in:5,10,25,50', // Updated validation rule for unit
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
        'unit' => $request->unit, // Use the updated unit
        'price' => $request->price,
        'method' => $request->method,
        'location' => $request->location,
        'order_date' => $request->order_date,
        'order_status' => 'pending',
    ]);

    return redirect()->route('store_manager.in-store-orders.index')->with('success', 'Order updated successfully!');
}


public function notifyDriversAboutNewOrders(Request $request)
{
    // Create a new In-Store Order
    $data = new OrderStore;  // Make sure 'OrderStore' is the correct model name
    $data->order_id = $request->order;  // Order ID from the request
    $data->product_id = $request->product;  // Product ID from the request
    $data->order_status = $request->status;  // Order status from the request
    $data->save();

    // Fetch new orders from the orderstore table where status is 'new'
    $orderStore = OrderStore::where('status', 'new')->get(); // Using Eloquent to fetch orders

    if ($orderStore->isNotEmpty()) {
        // Fetch all drivers
        $drivers = User::where('role', 'driver')->get(); // Fetch all drivers with 'driver' role

        foreach ($drivers as $driver) {
            // Send the notification to each driver
            $driver->notify(new NewOrderNotification($orderStore)); // Trigger the notification

            // Insert the notification into the database for each driver (optional if using the notify method)
            \DB::table('notifications')->insert([
                'id' => (string) Str::uuid(), // Generate a unique UUID for the notification
                'notifiable_type' => get_class($driver),
                'notifiable_id' => $driver->id,
                'type' => 'App\\Notifications\\NewOrderNotification', // Notification class type
                'data' => json_encode([
                    'message' => 'You have a new in-store order pending.',
                    'orderstore_ids' => $orderStore->pluck('id')->toArray(), // Include the order IDs as an array
                ]),
                'recipient_role' => 'driver', // Set the recipient role
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Notification sent to drivers about new orders.');
    } else {
        return redirect()->back()->with('error', 'No new in-store orders available.');
    }
}
}