<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ForecastController;
use App\Http\Controllers\InStoreController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockRequestController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\WalkinController;
use App\Http\Controllers\WarehouseManagerController;
use App\Http\Controllers\WarehousestockController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome')->middleware(['customer-dashboard']);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Route::get('login', [AuthController::class, 'login'])->name('auth.login');

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
    // Route::get('products', [ProductController::class, 'products'])->name('owner.products');

    // Route::get('/', function () {
    //     return redirect()->route('owner.products');
    // });

    Route::resource('products', ProductController::class);
    Route::get('/owner/products/index', [ProductController::class, 'products'])->name(name: 'owner.products.index');

    Route::get('/owner/products', [ProductController::class, 'products'])->name('owner.products');

    Route::get('create', [ProductController::class, 'create'])->name('owner.create');
    Route::post('products', [ProductController::class, 'store'])->name('owner.products.store');
    Route::get('products/{product}', [ProductController::class, 'show'])->name('owner.products.show');
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('owner.products.edit');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('owner.products.update');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('owner.products.destroy');

    Route::get('order', [ProductController::class, 'order'])->name('owner.order');
    Route::get('customer_order', [ProductController::class, 'customer_order'])->name('customer_order');
    Route::get('purchase_order', [ProductController::class, 'purchase_order'])->name('owner.purchase_order');
    Route::get('delivery', [ProductController::class, 'delivery'])->name('delivery');
    Route::get('inventory', [ProductController::class, 'inventory'])->name('inventory');
    Route::get('sales', [ProductController::class, 'sales'])->name('sales');
    Route::get('stocks', [ProductController::class, 'stocks'])->name('stocks');
    Route::get('warehouse_manager.warehouse', [WarehouseManagerController::class, 'warehouse'])->name('warehouse_manager.warehouse');

    // Route::resource('owner/truck', TruckController::class);
    Route::get('/owner/truck/index', [TruckController::class, 'index'])->name('owner.truck.index');
    Route::get('/owner/truck/create', [TruckController::class, 'create'])->name('owner.truck.create');
    Route::post('/truck', [TruckController::class, 'store'])->name('owner.truck.store');
    Route::get('/truck/{truck}/edit', [TruckController::class, 'edit'])->name('owner.truck.edit');
    Route::put('/truck/{truck}', [TruckController::class, 'update'])->name('owner.truck.update');
    Route::delete('/truck/{truck}', [TruckController::class, 'destroy'])->name('owner.truck.destroy');

    Route::prefix('owner/employee')->name('owner.employee.')->group(function () {
        Route::get('/index', [EmployeeController::class, 'index'])->name('index');
        Route::get('/create', [EmployeeController::class, 'create'])->name('create');
        Route::post('/store', [EmployeeController::class, 'store'])->name('store');
        Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])->name('edit');
        Route::put('/{employee}', [EmployeeController::class, 'update'])->name('update');
        Route::delete('/{employee}', [EmployeeController::class, 'destroy'])->name('destroy');
    });

    Route::get('/owner/delivery/delivery}', [DeliveryController::class, 'showdelivery'])->name('owner.delivery.delivery');
    Route::get('/owner/warehouse_stock/index', [WarehousestockController::class, 'showstock'])->name(name: 'owner.warehouse_stock.index');
    Route::get('/owner/purchase_stock/index', [PurchaseController::class, 'stock'])->name(name: 'owner.purchase_stock.index');
    Route::get('/owner/request_stock/index', [WarehouseManagerController::class, 'request'])->name(name: 'owner.request_stock.index');

    Route::get('/owner/store/index', [StoreController::class, 'index'])->name(name: 'owner.store.index');
    Route::get('/owner/store/create', [StoreController::class, 'create'])->name(name: 'owner.store.create');
    Route::post('/owner/store/store', action: [StoreController::class, 'store'])->name(name: 'owner.store.store');
    Route::get('store/{id}/edit', [StoreController::class, 'edit'])->name('owner.store.edit');
    Route::put('store/{store_id}', [StoreController::class, 'update'])->name('owner.store.update');
    Route::delete('store/{store_id}', [StoreController::class, 'destroy'])->name('owner.store.destroy');

    Route::get('/owner/employee/index', [EmployeeController::class, 'index'])->name('owner.employee.index');
    Route::get('/owner/employee/create', [EmployeeController::class, 'create'])->name('owner.employee.create');
    Route::get('/owner/employee/store', [EmployeeController::class, 'store'])->name('owner.employee.store');
    Route::get('employees/{employee_id}/edit', [EmployeeController::class, 'edit'])->name('owner.employee.edit');
    Route::put('employees/{employee_id}', [EmployeeController::class, 'update'])->name('owner.employee.update');
    Route::delete('/employee/{employee_id}', [EmployeeController::class, 'destroy'])->name('owner.employee.destroy');

    Route::get('/owner/order/order', action: [OrderController::class, 'order'])->name(name: 'owner.order.order');
    Route::get('/owner/sales/sales', action: [SalesController::class, 'sales'])->name(name: 'owner.sales.sales');

    Route::get('/owner/order/order', [ProductController::class, 'ordersOwner'])->name('owner.order.order');

});

Route::prefix('warehouse_manager')->group(function () {
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
    // Route::get('/clean-warehouse-stocks', [WarehouseManagerController::class, 'cleanZeroOrNegativeQuantityStocks']);
    Route::get('categorization', [WarehouseManagerController::class, 'categorization'])->name('categorization');
    Route::get('/warehouse-manager/notifications', [WarehouseManagerController::class, 'showNotifications'])->middleware('auth');

    /// Notification routes for warehouse_manager
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/mark-notifications-read', [NotificationController::class, 'markNotificationsRead'])->name('mark.notifications.read');
});

Route::prefix('store_manager')->group(function () {
    Route::resource('sales', SalesController::class);

    Route::get('/', function () {
        return redirect()->route('store_manager.sales.sales');
    });

    Route::get('/store_manager/sales/index', [SalesController::class, 'index'])->name('store_manager.sales.index');

    Route::get('orders/{id}', [OrderController::class, 'show'])->name('orders.show');

    Route::get('inventory/stockrequests', [StockRequestController::class, 'getAllStockRequest'])->name('store_manager.inventory.stockrequest');
    Route::post('inventory/stockrequests/add', [StockRequestController::class, 'addStock'])->name('store_manager.inventory.newstockrequest');

    Route::get('/store_manager/forecast/dashboard', [ForecastController::class, 'showDashboard'])->name('store_manager.forecast.dashboard');
    Route::post('/store_manager/forecast/upload-sales-data', [ForecastController::class, 'uploadSalesData'])->name('forecast.sales.upload');
    Route::post('/store_manager/forecast/run-forecast', [ForecastController::class, 'forecastSales'])->name('forecast.sales.run');
    Route::get('/store_manager/forecast/forecast-data', [ForecastController::class, 'getForecastData'])->name(name: 'forecast.sales.data');

    Route::get('/store_manager/forecast/index', [ForecastController::class, 'index'])->name(name: 'store_manager.forecast.index');

    Route::get('/store_manager/delivery/index', [DeliveryController::class, 'index'])->name('store_manager.delivery.index');
    Route::get('/store_manager/order/index', [OrderController::class, 'index'])->name('store_manager.order.index');
    Route::get('/store_manager/walk-in/index', [WalkinController::class, 'index'])->name('store_manager.walk-in.index');
    Route::get('/store_manager/pos', [WalkinController::class, 'index'])->name('store_manager.pos');
    Route::post('/store_manager/pos/submit', [WalkinController::class, 'submit'])->name('store_manager.pos.submit');
    Route::get('/store_manager/purchase_stock/index', [PurchaseController::class, 'index'])->name(name: 'store_manager.purchase_stock.index');
    Route::get('purchase-stock', [PurchaseController::class, 'index'])->name('store_manager.purchase_stock.index');
    Route::post('purchase-stock', [PurchaseController::class, 'submit'])->name('store_manager.purchase_stock.submit');
    Route::get('/store_manager/warehouse_stock/index', [WarehousestockController::class, 'index'])->name(name: 'store_manager.warehouse_stock.index');
    Route::post('/store_manager.orders/index', [ProductController::class, 'submitWalkinOrder'])->name('store_manager.orders.walkin_orders');
    Route::get('/store-manager/walk-in/index', [ProductController::class, 'showWalkInSales'])->name(name: 'store_manager.walk-in.index');
    Route::get('/store-manager/walk-in/add', [ProductController::class, 'addWalkIn'])->name(name: 'store_manager.walk-in.add');
    Route::post('/store-manager/walk-in/store', [SalesController::class, 'storeWalkInSale'])->name('store_manager.walk-in.store');

    //order
    // Route::patch('/orders/{id}/status', [ProductController::class, 'updateStatus'])
    // ->name('store_manager.orders.update_status');
    // Route::get('/store-manager/store_orders/index', [OrderController::class, 'getOrders'])->name('store_manager.store_orders.index');

    Route::get('/store_manager.orders.index', action: [OrderController::class, 'orders'])->name('store_manager.orders.index');
    Route::get('/store_manager.orders/walkin_order', [OrderController::class, 'showWalkinForm'])->name('store_manager.orders.walkin_order');
    Route::post('/orders', [OrderController::class, 'store'])->name('store_manager.orders.store');

    Route::get('/store-manager/stocks/index', [StockController::class, 'index'])->name('store_manager.stocks.index');
    Route::get('/store-manager/stocks/create', [StockController::class, 'create'])->name('store_manager.stocks.create');
    Route::post('/store-manager/stocks/store', [StockController::class, 'store'])->name('store_manager.stocks.store');
    Route::patch('/orders/{orderId}/status', [OrderController::class, 'updateStatus'])->name('store_manager.orders.updateStatus');

    // products

    Route::get('/store_manager/products/index', [ProductController::class, 'index'])->name('store_manager.products.index');
    Route::get('store_manager/products/create', [ProductController::class, 'create'])->name('store_manager.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('store_manager.products.store');
    Route::get('store_manager/products/{product}/edit', [ProductController::class, 'edit'])->name('store_manager.products.edit');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('store_manager.products.update');
    Route::delete('/store_manager.products/{product}', [ProductController::class, 'destroy'])->name('store_manager.products.destroy');

    // MA
    Route::get('/store_manager/forecasting/index', [ForecastController::class, 'showMovingAverage'])->name(name: 'store_manager.forecasting.index');

    //instore orders
    Route::get('/store_manager/in-store-orders/index', [InStoreController::class, 'index'])->name(name: 'store_manager.in-store-orders.index');
    Route::get('/store_manager/in-store-orders/create', [InStoreController::class, 'create'])->name('store_manager.in-store-orders.create');
    Route::post('/store_manager/in-store-orders/store', [InStoreController::class, 'store'])->name('store_manager.in-store-orders.store');
    Route::get('in-store-orders/{order}/edit', [InStoreController::class, 'edit'])->name('store_manager.in-store-orders.edit');
    Route::put('in-store-orders/{order}', [InStoreController::class, 'update'])->name('store_manager.in-store-orders.update');
    Route::delete('in-store-orders/{order}', [InStoreController::class, 'destroy'])->name('store_manager.in-store-orders.destroy');
    Route::put('/orders/{order_id}/update-status', [InStoreController::class, 'updateStatus'])
        ->name('store_manager.in-store-orders.update-status');

    // Route::get('inventory/stockrequests', [StockRequestController::class, 'getAllStockRequest'])->name('store_manager.inventory.stockrequest');
    // Route::post('inventory/stockrequests/add', [StockRequestController::class, 'addStock'])->name('store_manager.inventory.newstockrequest');
});

Route::prefix('driver')->group(function () {
    Route::get('/routes', [DriverController::class, 'view'])->name('routes');
    Route::get('/orders', [DriverController::class, 'orders'])->name('orders');
    Route::get('/schedule', [DriverController::class, 'schedule'])->name('schedule');
    Route::get('/markers', [App\Http\Controllers\MapController::class, 'getMarkers']);
});

// FOR CUSTOMER
Route::prefix('customer')->group(function () {
    Route::get('/order-list', [CustomerController::class, 'orders'])->name('order-list');
    Route::get('/history', [CustomerController::class, 'history'])->name('customer.history.index');

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
    Route::post('/order-list', [CartController::class, 'placeOrder'])->name('cart.placeOrder');
    Route::get('customer/customer-order-details/{order}', [CartController::class, 'orderDetails'])->name('customer.order-details');
    Route::patch('/order/{order}/cancel', [CartController::class, 'cancelOrder'])->name('order.cancel');

    //History
    Route::get('/order-history-details/{id}', [OrderHistoryController::class, 'showOrderDetails'])->name('order.history.details');
    Route::delete('/history/{id}', [OrderHistoryController::class, 'destroy'])->name('customer.history.destroy');

    // Confirm Delivery
    Route::post('/confirm-delivery', [OrderController::class, 'confirmDelivery'])->name('customer.confirm-delivery');
    Route::get('/history', [OrderHistoryController::class, 'index'])->name('history');
});

Route::get('/home', function () {
    return view('home');
});

require __DIR__.'/auth.php';
