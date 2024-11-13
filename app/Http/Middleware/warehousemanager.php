<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class warehousemanager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = Auth::user()->role;

        if ($userRole == 'warehouse_manager') {
            return $next($request);
        }

        if ($userRole == 'owner') {
            return redirect()->route('owner-dashboard');
        }

        if ($userRole == 'store_manager') {
            return redirect()->route('store-manager-dashboard');
        }

        if ($userRole == 'customer') {
            return redirect()->route('customer-dashboard');
        }

        if ($userRole == 'driver') {
            return redirect()->route('orders');
        }

        // Add this line to explicitly return a response for other roles
        return abort(403, 'Unauthorized'); // You can customize the error message and code
    }
}
