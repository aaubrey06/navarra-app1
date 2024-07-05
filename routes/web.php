<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\WarehouseManagerController;
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

    Route::get('/trucks', [TruckController::class, 'index'])->name('owner.truck');
    Route::get('/employees', [EmployeeController::class, 'employee'])->name('owner.employee');

});

Route::prefix('warehouse_manager')->group(function () {

    // Route::get('dashboard', [ProductController::class, 'dashboard'])->name('dashboard');
    Route::get('warehouse', [WarehouseManagerController::class, 'warehouse'])->name('warehouse');
    Route::get('generate-qr', [WarehouseManagerController::class, 'generateQR'])->name('generateQR');
    Route::get('create', [WarehouseManagerController::class, 'create'])->name('wm_create');
    Route::get('purchase_req', [WarehouseManagerController::class, 'purchase_req'])->name('purchase_req');
    Route::post('warehouse', [WarehouseManagerController::class, 'warehouse'])->name('warehouse');
    Route::get('qrScan', [WarehouseManagerController::class, 'qrScan'])->name('qrScan');
    Route::post('add_stocks', [WarehouseManagerController::class, 'add_stocks']);
    Route::get('foroutbound/{qrCode}', [WarehouseManagerController::class, 'foroutbound'])->name('foroutbound');
    Route::get('outbound_stocks', [WarehouseManagerController::class, 'outbound_stocks'])->name('outbound_stocks');
    Route::post('sendoutbound', [WarehouseManagerController::class, 'sendoutbound']);
    // Route::post('update_stocks', [WarehouseManagerController::class, 'update_stocks'])->name('update_stocks');
});

Route::prefix('store_manager')->group(function () {

    Route::resource('sales', SalesController::class);
    Route::resource('sales', 'SalesController');

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

});

Route::prefix('driver')->group(function () {
    Route::get('/routes', [DriverController::class, 'view'])->name('routes');
    Route::get('/orders', [DriverController::class, 'orders'])->name('orders');
    Route::get('/schedule', [DriverController::class, 'schedule'])->name('schedule');
});

// FOR CUSTOMER
Route::prefix('customer')->group(function () {
    Route::get('/cart', [CustomerController::class, 'view'])->name('cart');
    Route::get('/order-list', [CustomerController::class, 'orders'])->name('order-list');
    Route::get('/history', [CustomerController::class, 'history'])->name('history');
    Route::get('/customer-dashboard', [CustomerController::class, 'products'])->name('customer-dashboard');
});

require __DIR__.'/auth.php';
