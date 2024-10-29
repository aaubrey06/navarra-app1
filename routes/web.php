<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\WarehouseManagerController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;




Route::view('/', 'welcome')->name('welcome')->middleware(['customer-dashboard']);

// To Delete
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
// To Delete

Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'verified', 'customer-dashboard'])->group(function () {
    Route::view('customer-dashboard', 'customer.customer-dashboard')->name('customer-dashboard');
});

Route::middleware(['auth', 'verified', 'orders'])->group(function () {
    Route::view('orders', 'driver.orders')->name('orders');
});

Route::middleware(['auth', 'verified', 'owner-dashboard'])->group(function () {
    Route::view('owner-dashboard', 'owner.owner-dashboard')->name('owner-dashboard');
});

Route::middleware(['auth', 'verified', 'warehouse'])->group(function () {
    Route::view('warehouse', 'warehouse_manager.warehouse')->name('warehouse');
});

Route::middleware(['auth', 'verified', 'store-manager-dashboard'])->group(function () {
    Route::view('store-manager-dashboard', 'store_manager.store-manager-dashboard')->name('store-manager-dashboard');
});

Route::prefix('owner')->group(function () {

    // Route::get('dashboard', [ProductController::class, 'dashboard'])->name('dashboard');

    Route::get('products', [ProductController::class, 'products'])->name('owner.products');

    Route::get('/', function () {
        return redirect()->route('owner.products');
    });

    Route::resource('products', ProductController::class);

    Route::get('products', [ProductController::class, 'products'])->name('owner.products');
    Route::get('create', [ProductController::class, 'create'])->name('owner.create');
    Route::post('products', [ProductController::class, 'store'])->name('owner.products.store');
    Route::get('owner/products/{product}', [ProductController::class, 'show'])->name('owner.products.show');
    Route::get('owner/products/{product}/edit', [ProductController::class, 'edit'])->name('owner.products.edit');
    Route::put('owner/products/{product}', [ProductController::class, 'update'])->name('owner.products.update');
    Route::delete('owner/products/{product}', [ProductController::class, 'destroy'])->name('owner.products.destroy');

    Route::get('order', [ProductController::class, 'order'])->name('owner.order');
    Route::get('customer_order', [ProductController::class, 'customer_order'])->name('customer_order');
    Route::get('purchase_order', [ProductController::class, 'purchase_order'])->name('owner.purchase_order');
    Route::get('delivery', [ProductController::class, 'delivery'])->name('delivery');
    Route::get('inventory', [ProductController::class, 'inventory'])->name('inventory');
    Route::get('sales', [ProductController::class, 'sales'])->name('sales');
    Route::get('stocks', [ProductController::class, 'stocks'])->name('stocks');
    Route::get('reports', [ProductController::class, 'reports'])->name('reports');
    Route::get('warehouse_manager.warehouse', [WarehouseManagerController::class, 'warehouse'])->name('warehouse_manager.warehouse');

    // Route::get('truck', [TruckController::class, 'truck'])->name('owner.truck');
    // Route::get('employee', [EmployeeController::class, 'employee'])->name('owner.employee');

    Route::get('/trucks', [TruckController::class, 'truck'])->name('owner.truck');
    Route::get('/employees', [EmployeeController::class, 'employee'])->name('owner.employee');

});

Route::prefix('warehouse_manager')->group(function () {

    // Route::get('dashboard', [ProductController::class, 'dashboard'])->name('dashboard');
    Route::get('warehouse', [WarehouseManagerController::class, 'warehouse'])->name('warehouse');
    Route::get('generate-qr', [WarehouseManagerController::class, 'generateQR'])->name('generateQR');
    Route::get('create', [WarehouseManagerController::class, 'create'])->name('wm_create');
    Route::get('purchase_req', [WarehouseManagerController::class, 'purchase_req'])->name('purchase_req');
    Route::post('warehouse', [WarehouseManagerController::class, 'warehouse'])->name('warehouse');
    Route::get('qrScan/{id}', [WarehouseManagerController::class, 'qrScan'])->name('qrScan');
    Route::post('add_stocks', [WarehouseManagerController::class, 'add_stocks']);
    Route::get('foroutbound', [WarehouseManagerController::class, 'foroutbound'])->name('foroutbound');
    Route::get('outbound_stocks', [WarehouseManagerController::class, 'outbound_stocks'])->name('outbound_stocks');
    Route::post('sendoutbound', [WarehouseManagerController::class, 'sendoutbound']);
    Route::get('categorization', [WarehouseManagerController::class, 'categorization'])->name('categorization');
    // Route::post('update_stocks', [WarehouseManagerController::class, 'update_stocks'])->name('update_stocks');
});

Route::prefix('store_manager')->group(function () {

    Route::resource('sales', SalesController::class);
    Route::resource('sales', 'SalesController');

    Route::get('orders/index', [OrderController::class, 'orders'])->name('store_manager.orders.index');

    Route::get('/', function () {
        return redirect()->route('store_manager.sales.sales');
    });

    Route::get('sales', [SalesController::class, 'sales'])->name('store_manager.sales.sales');
    Route::get('sales/{sale}', [SalesController::class, 'show'])->name('store_manager.sales.show');
    Route::get('sales/create', [SalesController::class, 'create'])->name('store_manager.sales.create');
    Route::get('sales/{sale}/edit', [SalesController::class, 'edit'])->name('store_manager.sales.edit');
    Route::put('sales/{sale}', [SalesController::class, 'update'])->name('store_manager.sales.update');
    Route::post('sales', [SalesController::class, 'store'])->name('store_manager.sales.store');
    Route::delete('sales/{sale}', [SalesController::class, 'destroy'])->name('store_manager.sales.destroy');
    // Route::post('sales', [SalesController::class, 'store'])->name('store_manager.sales.sales');
    // Route::get('sales/create', [SalesController::class, 'create'])->name('store_manager.sales.create');
<<<<<<< Updated upstream
    Route::get('/purchase_orders/create', [PurchaseOrderController::class, 'create'])->name('purchase_orders.create');
    Route::get('/purchase-orders', [PurchaseOrderController::class, 'index'])->name('store_manager.purchase_order.index');
    // Route::post('/purchase-orders', [PurchaseOrderController::class, 'store'])->name('purchase_orders.store');
=======

    
    Route::get('/orders', [OrderController::class, 'index'])->name('store_manager.order.index');
    Route::get('orders/{id}', [OrderController::class, 'show'])->name('orders.show');
>>>>>>> Stashed changes
});

Route::prefix('driver')->group(function () {
    Route::get('/routes', [DriverController::class, 'view'])->name('routes');
    Route::get('/orders', [DriverController::class, 'orders'])->name('orders');
    Route::get('/schedule', [DriverController::class, 'schedule'])->name('schedule');
});

// FOR CUSTOMER
Route::prefix('customer')->group(function () {
    // Route::get('/cart', [CustomerController::class, 'view'])->name('cart');
    Route::get('/order-list', [CustomerController::class, 'orders'])->name('order-list');
    Route::get('/history', [CustomerController::class, 'history'])->name('history');

    //Products
    Route::get('/customer-dashboard', [CustomerController::class, 'products'])->name('customer-dashboard');

    //Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{product_id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

    //Summary
    Route::get('/order-summary', [CartController::class, 'summary'])->name('cart.summary');

    //Order-list
    Route::get('/order-list', [CartController::class, 'orders'])->name('cart.order-list');
    Route::post('/order-list', [CartController::class, 'placeOrder'])->name('cart.placeOrder');
    Route::get('customer/customer-order-details/{order}', [CartController::class, 'orderDetails'])->name('customer.order-details');
    Route::patch('/order/{order}/cancel', [CartController::class, 'cancelOrder'])->name('order.cancel');

    //History
    Route::get('/order-history-details/{id}', [OrderHistoryController::class, 'showOrderDetails'])->name('order.history.details');
    Route::get('/history', [OrderHistoryController::class, 'index'])->name('customer.history.index');
    Route::get('/history', [OrderHistoryController::class, 'history'])->name('customer.history.history');
    Route::delete('/history/{id}', [OrderHistoryController::class, 'destroy'])->name('customer.history.destroy');

    //Confirm Delivery
    Route::post('/order/{order}/confirm', [CartController::class, 'confirmDelivery'])->name('order.confirm');

    // Route::get('/order-list', [CartController::class, 'orders'])->name('order-list');
    Route::get('/history', [OrderHistoryController::class, 'index'])->name('history');

});

require __DIR__.'/auth.php';

// FOR DRIVER

Route::get('/markers', [App\Http\Controllers\MapController::class, 'getMarkers']);
