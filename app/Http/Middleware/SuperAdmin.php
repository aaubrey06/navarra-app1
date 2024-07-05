<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }

        $userRole=Auth::user()->role;

        if($userRole=='super_admin'){
            return $next($request);
        }

        if($userRole=='owner'){
            return redirect()->route('owner-dashboard');
        }

        if($userRole=='warehouse_manager'){
            return redirect()->route('warehouse');
        }

        if($userRole=='customer'){
            return redirect()->route('customer-dashboard');
        }

        if($userRole=='driver'){
            return redirect()->route('orders');
        }

        // Add this line to explicitly return a response for other roles
        return abort(403, 'Unauthorized');
    }
}

 //     if (Auth::check() && Auth::user()->role == 'super_admin') {
    //         return $next($request); // Allow Super Admin to access the requested route
    //     }

    //     // If the user is not a Super Admin, abort with a 403 error
    //     return abort(403, 'Unauthorized'); // You can customize the error message and code
    // //     return redirect()->route('home');
    // // }