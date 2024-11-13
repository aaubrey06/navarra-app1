<?php

namespace App\Http\Controllers;

use App\Notifications\OrderShippedNotification;
use Illuminate\View\View;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use DB;
class OrderController extends Controller
{
// public function shipOrder($orderId)
// {
//     $order = Order::find($orderId);
//     $user = User::find($order->user_id);

//     // Notify the user
//     $user->notify(new OrderShippedNotification($order));

//     return response()->json(['status' => 'Order shipped and notification sent']);
// }

    // public function customerOrder(): View
    // {
    // return view('store_manager.store_orders.index');
    // }

    
    // public function customerOrder($customerId)
    // {
       
    //     $customer = Customer::findOrFail($customerId);

    //     $orders = Order::where('customer_id', $customer->customer_id)->get();

    //     return view('store_manager.store_orders.index', compact('orders', 'customer'));
    // }

    // //store order
    // public function getOrders() {
    //     $orders = Order::whereHas('orderStatus', function ($query) {
    //         $query->where('status_name', 'pending');  // Correct column 'status_name' instead of 'status'
    //     })->get();
        
    //     return view('store_manager.store_orders.index', compact('orders'));
    // }
    
    public function getOrders($status = null)
    {
        // If the status is provided, filter orders by status
        if ($status) {
            $orders = Order::where('order_status', $status)->get();
        } else {
            // Otherwise, get all orders
            $orders = Order::all();
        }

        return view('store_manager.store_orders.index', compact('orders'));
    }

    public function orders()
    {
        // Fetch orders with the related customer and order status
        $orders = Order::with(['customer', 'orderStatus', 'product']) // Ensure to load relationships
        ->paginate(10);
    
        return view('store_manager.orders.index', compact('orders'));
    }
    public function showWalkinForm()
    {
        $products = Product::all();
        return view('store_manager.orders.walkin_order', compact('products')); 
    }
    public function store(Request $request)
{
    // Validate the incoming request data
    $validated = $request->validate([
        'customer_name' => 'required|string|max:255',
        'product_id' => 'required|exists:products,id', // Ensure the product exists
        'quantity' => 'required|integer|min:1',
        'unit' => 'required|string|max:50',
        'order_type' => 'required|in:pickup,delivery', // Only pickup or delivery allowed
        'address' => 'nullable|string|max:255', // Nullable for pickup orders
    ]);

    try {
        // Use a database transaction to ensure data integrity
        DB::transaction(function () use ($validated) {
            // Create or find the customer by their name
            $customer = Customer::firstOrCreate(['name' => $validated['customer_name']]);

            // Find the product by its ID
            $product = Product::find($validated['product_id']);
            if (!$product) {
                return redirect()->back()->with('error', 'Product not found.');
            }

            // Prepare the order data
            $orderData = [
                'customer_id' => $customer->customer_id,
                'product_id' => $validated['product_id'], // Save the product ID
                'quantity' => $validated['quantity'],
                'unit' => $product->unit, // Save the unit from the product table
                'method' => $validated['order_type'], // Save the order type as 'method'
                'order_date' => now(),
                'rice_type' => $product->rice_type, // Save the rice_type from the product
                'tracking_no' => uniqid('tracking_'), // Generate a unique tracking number
                'payment_status' => 'pending', // Default payment status (can be changed later)
                'location' => $validated['order_type'] === 'delivery' ? $validated['address'] : null, // Save address if delivery
            ];

            // Create the order
            Order::create($orderData);
        });

        // Redirect upon success
        return redirect()->route('store_manager.orders.index')
                         ->with('success', 'Order placed successfully!');
    } catch (\Exception $e) {
        // Handle errors and rollback the transaction if an exception occurs
        \Log::error('Error placing order: ' . $e->getMessage());
        return redirect()->back()->with('error', 'An unexpected error occurred while placing the order.');
    }
}



    public function getFullAddress()
    {
        
        if (isset($this->latitude) && isset($this->longitude) && $this->latitude != '' && $this->longitude != '') {
            $apiKey = env('GOOGLE_MAPS_API_KEY');
            $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng={$this->latitude},{$this->longitude}&key={$apiKey}";
    
            $client = new \GuzzleHttp\Client();
            $response = $client->get($url);
            $data = json_decode($response->getBody(), true);
    
            if ($data['status'] == 'OK') {
                return $data['results'][0]['formatted_address'];  // Return a readable address
            } else {
                return 'Invalid location data';  
        }
    
        return 'Location not available';  
    }
    






    // public function order(): View
    // {
    //     $orders = Order::all(); // Get all orders from the database
    //     return view('owner.order.order', compact('orders'));
    // }

    
}
}