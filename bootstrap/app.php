<?php

use App\Http\Middleware\RoleAuth;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Owner;
use App\Http\Middleware\Storemanager;
use App\Http\Middleware\Warehousemanager;
use App\Http\Middleware\Driver;
use App\Http\Middleware\Customer;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'owner-dashboard' => Owner::class,
            'store-manager-dashboard' => Storemanager::class,
            'warehouse-manager-dashboard' => Warehousemanager::class,
            'driver-dashboard' => Driver::class,
            'customer-dashboard' => Customer::class,
            // 'super-admin' => SuperAdmin::class,
            'roleauth' => RoleAuth::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
