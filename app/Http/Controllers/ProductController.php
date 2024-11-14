<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;





class ProductController extends Controller
{
    public function dashboard(): View
    {
        $user = Auth::user();

        return view('owner.owner-dashboard');
    }

    public function customer_order(): View
    {
        return view('owner.customer_order');
    }

    public function purchase_order(): View
    {
        return view('owner.purchase_order');
    }

    public function stocks(): View
    {
        $products = Product::all();         
        return view('owner.stocks', compact('products'));
    }

    public function products(): View
    {
        $products = Product::all();

        return view('owner.products.index', compact('products')); 
    }

   
   
    //////// FOR STOREM

        //products

    public function index(): View
    {
        $products = Product::all();
        return view('store_manager.products.index', compact('products'));
    }

    public function create()
    {
        return view('store_manager.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'rice_type' => 'required|string|max:255',
            'unit' => 'required|in:5,10,25,50',
            'unit_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'target_level' => 'required|integer',
            'reorder_level' => 'required|integer',
        ]);

        $product = new Product();
        $product->rice_type = $request->rice_type;
        $product->unit = $request->unit;
        $product->unit_price = $request->unit_price;
        $product->selling_price = $request->selling_price;
        $product->target_level = $request->target_level;
        $product->reorder_level = $request->reorder_level;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('store_manager.products.index')->with('success', 'Product added successfully!');
    }

    public function edit(Product $product)
    {
        return view('store_manager.products.edit', compact('product'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
           
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'rice_type' => 'required|string|max:255',
            'unit' => 'required|in:5,10,25,50',
            'unit_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'target_level' => 'required|integer',
            'reorder_level' => 'required|integer',
        ]);

        $product = Product::findOrFail($id);
        $product->rice_type = $request->rice_type;
        $product->unit = $request->unit;
        $product->unit_price = $request->unit_price;
        $product->selling_price = $request->selling_price;
        $product->target_level = $request->target_level;
        $product->reorder_level = $request->reorder_level;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('store_manager.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        
        return redirect()->route('store_manager.products.index')->with('success', 'Product deleted successfully!');
    }


    //orders

   
    // public function orders(): View
    // {
    //     return view('store_manager.orders.index'); 
    // }

    public function ordersOwner()
    {
       
        $orders = Order::all(); 
        return view('owner.order.order', compact('orders'));  
    }

    

    public function updateStatus(Request $request, $id)
    {
        // Validate status
        $request->validate([
            'status' => 'required|in:pending,shipping,delivered',
        ]);

        // Find the order
        $order = Order::findOrFail($id);

        // Get the status ID from the status name
        $orderStatus = OrderStatus::where('status', $request->status)->first();

        if ($orderStatus) {
            $order->order_status_id = $orderStatus->id;
            $order->save();

            // Return success message
            return redirect()->route('store_manager.orders.index')->with('success', 'Order status updated successfully!');
        }

        // If status is invalid
        return back()->withErrors(['status' => 'Invalid status value']);
    }




   



    // public function submitWalkinOrder(Request $request)
    // {
       
    //     $validatedData = $request->validate([
    //         'customer_name' => 'required|string|max:255',
    //         'order_type' => 'required|in:pickup,delivery',
    //     ]);
    //     return redirect()->route('store_manager.orders.index')->with('success', 'Walk-in order submitted successfully!');
    // }

    public function showWalkInSales()
    {
        $sales = Sale::all();
    
        
        return view('store_manager.walk-in.index', compact('sales'));
    
    }
    public function addWalkIn()
    {

        $products = Product::all();

   
    return view('store_manager.walk-in.add', compact('products'));
    }

    public function storeWalkInSale(Request $request)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,product_id', // Ensure product exists
            'quantity_sold' => 'required|integer|min:1', // Ensure quantity_sold is a positive integer
        ]);
    
        // Log the validated data to see if it's correct
        Log::debug('Validated data: ', $validatedData);
    
        // Retrieve the selected product from the database
        $product = Product::find($validatedData['product_id']);
    
        // Log the product data to verify it's being fetched correctly
        Log::debug('Product Data: ', $product ? $product->toArray() : 'Product not found');
    
        if (!$product) {
            return redirect()->back()->withErrors(['product_id' => 'Product not found.']);
        }
    
        if ($product->current_quantity < $validatedData['quantity_sold']) {
            return redirect()->back()->withErrors(['quantity_sold' => 'Not enough stock available']);
        }
    
        // Calculate the total price (selling_price * quantity sold)
        $totalPrice = $product->selling_price * $validatedData['quantity_sold'];
    
        // Begin a database transaction
        DB::beginTransaction();
    
        try {
            // Decrease the product quantity by the sold amount
            $product->current_quantity -= $validatedData['quantity_sold'];
            $product->save(); // Save the updated product
    
            // Log before creating the sale to ensure everything is ready
            Log::debug('Creating sale with data: ', [
                'product_id' => $product->product_id,
                'quantity_sold' => $validatedData['quantity_sold'],
                'total_price' => $totalPrice,
                'sale_date' => now(),
            ]);
    
            // Create a new sale record
            Sale::create([
                'product_id' => $product->product_id,
                'quantity_sold' => $validatedData['quantity_sold'],
                'total_price' => $totalPrice,
                'sale_date' => now(),
            ]);
    
            // Commit the transaction
            DB::commit();
    
            return redirect()->route('store_manager.walk-in.index')->with('success', 'Sale recorded successfully!');
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();
    
            // Log the exception
            Log::error('Error during sale creation: ' . $e->getMessage());
    
            return redirect()->back()->withErrors(['sale' => 'Failed to record the sale.']);
        }
    }
    
    
 
//     public function storeWalkInSale(Request $request)
// {
//     // Validate incoming data
//     $validatedData = $request->validate([
//         'product_id' => 'required|exists:products,product_id', // Ensure product exists
//         'quantity_sold' => 'required|integer|min:1', // Ensure quantity_sold is a positive integer
//     ]);

//     // Retrieve the selected product from the database
//     $product = Product::find($validatedData['product_id']);

//     // Check if there is enough stock available
//     if ($product->current_quantity < $validatedData['quantity_sold']) {
//         return redirect()->back()->withErrors(['quantity_sold' => 'Not enough stock available']);
//     }

//     // Calculate the total price (selling_price * quantity sold)
//     $totalPrice = $product->selling_price * $validatedData['quantity_sold'];

//     // Use a transaction to ensure atomicity
//     DB::beginTransaction();

//     try {
//         // Decrease the product quantity by the sold amount
//         $product->current_quantity -= $validatedData['quantity_sold'];
//         $product->save(); // Save the updated product

//         // Create a new sale record
//         Sale::create([
//             'product_id' => $product->product_id, 
//             'quantity_sold' => $validatedData['quantity_sold'],  
//             'total_price' => $totalPrice,
//             'sale_date' => now(),  
//         ]);

//         // Commit the transaction
//         DB::commit();

//         return redirect()->route('store_manager.walk-in.index')->with('success', 'Sale recorded successfully!');
//     } catch (\Exception $e) {
//         DB::rollBack();
//         Log::error('Error in transaction: ' . $e->getMessage());
//         return redirect()->back()->withErrors(['sale' => 'Failed to record the sale.']);
//     }
// }


}