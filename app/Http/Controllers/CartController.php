<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetails;

use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //INDEX
    public function index()
    {
        $cartItems = session()->get('cartItems', []);
        return view('customer.cart', compact('cartItems'));
    }

    //STORE
    public function store(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        // $product = Product::where('product_id', $productId)->first();
        $product = Product::find($productId);

        if ($product) {
            $cartItems = session()->get('cartItems', []);

            // Check if the product already exists in the cart
            $existingItemKey = null;
            foreach ($cartItems as $key => $item) {
                if ($item['product_id'] == $productId) {
                    $existingItemKey = $key;
                    break;
                }
            }

            if ($existingItemKey !== null) {
                // Update the quantity and total selling price of the existing item
                $cartItems[$existingItemKey]['quantity'] += $quantity;
                $cartItems[$existingItemKey]['total_selling_price'] = $cartItems[$existingItemKey]['selling_price'] * $cartItems[$existingItemKey]['quantity'];
            } else {
                // Add new product to cart
                $cartItem = [
                    'product_id' => $product->product_id,
                    'rice_type' => $product->rice_type,
                    'unit' => $product->unit,
                    'selling_price' => $product->selling_price,
                    'quantity' => $quantity,
                    'total_selling_price' => $product->selling_price * $quantity
                ];

                $cartItems[] = $cartItem;
            }

            session()->put('cartItems', $cartItems);

            return redirect()->back()->with('status', 'Product added to the cart');
        }


        // if ($product) {

        //     $cartItem = [
        //         'product_id' => $product->product_id,
        //         'rice_type' => $product->rice_type,
        //         'unit' => $product->unit,
        //         'selling_price' => $product->selling_price,
        //         'quantity' => $quantity,
        //         'total_selling_price' => $product->selling_price * $quantity
        //     ];

        //     $cartItems = session()->get('cartItems', []);
        //     $cartItems[] = $cartItem;
        //     session()->put('cartItems', $cartItems);

        //     return redirect()->back()->with('status', 'Product added to the cart');
        //     // return redirect()->back()->with('status', 'Product added to the cart')->with('cartItems', $cartItems);
        // }
        return redirect()->back()->with('status', 'Product not found');
    }

    //REMOVE
    public function remove($product_id)
    {
        $cartItems = session()->get('cartItems', []);
        $updatedCartItems = [];

        foreach ($cartItems as $item) {
            if ($item['product_id'] != $product_id) {
                $updatedCartItems[] = $item;
            }
        }

        session()->put('cartItems', $updatedCartItems);

        return redirect()->back()->with('status', 'Product removed from the cart');
    }

    //SUMMARY
    public function summary()
    {
        $user = Auth::user();
        $customer = \App\Models\Customer::where('user_id', $user->id)->first(); // Fetch the customer data

        $cartItems = session()->get('cartItems', []);

        return view('customer.order-summary', compact('cartItems', 'user', 'customer'));
    }

    //PLACE ORDER
    // public function placeOrder(Request $request)
    // {
    //     $cartItems = session()->get('cartItems', []);

    //     if (empty($cartItems)) {
    //         return redirect()->back()->with('status', 'Your cart is empty');
    //     }

    //     $order = Order::create([
    //         'tracking_no' => Str::random(10),
    //         'delivery_date' => now()->addDays(7), // I-change pa ni sa
    //         'payment_status' => 'Pending',
    //         'order_status' => 'Processing',
    //     ]);

    //     foreach ($cartItems as $item) {
    //         OrderDetails::create([
    //             'order_id' => $order->id,
    //             'product_id' => $item['product_id'],
    //             'rice_type' => $item['rice_type'],
    //             'unit' => $item['unit'],
    //             'selling_price' => $item['selling_price'],
    //             'quantity' => $item['quantity'],
    //             'total_selling_price' => $item['total_selling_price'],
    //         ]);
    //     }

    //     // Update order status to "Delivered"
    //     $order->update([
    //         'order_status' => 'Delivered'
    //     ]);

    //     session()->forget('cartItems');

    //     return redirect()->route('cart.order-list')->with('status', 'Order placed successfully');
    // }

    public function placeOrder(Request $request)
    {
        $cartItems = session()->get('cartItems', []);

        if (empty($cartItems)) {
            return redirect()->back()->with('status', 'Your cart is empty');
        }

        // Capture the delivery option from the request
        $deliveryOption = $request->input('delivery_option');

        $order = Order::create([
            'tracking_no' => Str::random(10),
            // 'delivery_date' => now()->addDays(7), // Adjust delivery date logic
            'delivery_date' => now(),
            'payment_status' => 'Pending',
            'order_status' => 'Processing',
            'delivery_option' => $deliveryOption,
        ]);

        // Link OrderDetails to Order (if applicable)
        foreach ($cartItems as $item) {
            OrderDetails::create([
                'order_id' => $order->order_id,
                'product_id' => $item['product_id'],
                'rice_type' => $item['rice_type'],
                'unit' => $item['unit'],
                'selling_price' => $item['selling_price'],
                'quantity' => $item['quantity'],
                'total_selling_price' => $item['total_selling_price'],
            ]);
        }

        session()->forget('cartItems');

        // Retrieve all orders (or filter based on desired criteria)
        $orders = Order::all(); // Replace with appropriate filtering logic

        return redirect()->route('cart.order-list')->with('status', 'Order placed successfully');
        // return view('customer.order-list', compact('orders'));
    }

    //ORDERS
    public function orders()
    {
        // $cartItems = session()->get('cartItems', []);
        // return view('customer.order-list', compact('cartItems'));

        // $orders = Order::with('orderDetails')->get();
        // return view('customer.order-list', compact('orders'));

        // $orders = Order::where('order_status', '!=', 'Delivered')->get(); // Fetch orders that are not delivered
        $orders = Order::whereNotIn('order_status', ['Delivered', 'Cancelled'])->get();
        return view('customer.order-list', compact('orders'));
    }

    //UPDATE QUANTITY AND TOTAL SELLING PRICE
    public function update(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $cartItems = session()->get('cartItems', []);

        foreach ($cartItems as $key => $item) {
            if ($item['product_id'] == $productId) {
                $cartItems[$key]['quantity'] = $quantity;
                $cartItems[$key]['total_selling_price'] = $cartItems[$key]['selling_price'] * $quantity;
                break;
            }
        }

        session()->put('cartItems', $cartItems);

        return response()->json([
            'success' => true,
            'total_selling_price' => $cartItems[$key]['total_selling_price']
        ]);
    }

    //Comfirming the Delivery
    public function confirmDelivery(Request $request, Order $order)
    {
        // Update order status to "Delivered"
        $order->update([
            'order_status' => 'Delivered'
        ]);

        return redirect()->back()->with('status', 'Order confirmed as delivered!');
    }

    //View Order Details
    public function orderDetails(Order $order)
    {
        $user = Auth::user();
        $customer = \App\Models\Customer::where('user_id', $user->id)->first(); // Fetch the customer data
        // $orderDetails = OrderDetails::where('order_id', $order->id)->get();
        $orderDetails = $order->orderDetails;

        return view('customer.customer-order-details', compact('order', 'orderDetails', 'user', 'customer'));
    }

    //Cancel Order
    public function cancel(Order $order)
    {
        $order = Order::findOrFail($order->order_id);

        // Update the order status to "Cancelled"
        $order->update([
            'order_status' => 'Cancelled',
        ]);

        // You can also move this order to a history or perform any additional logic here

        return redirect()->back()->with('status', 'Order cancelled successfully.');
    }

}
