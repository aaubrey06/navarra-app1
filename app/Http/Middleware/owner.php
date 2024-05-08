<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class owner
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

        if($userRole==1){
            return $next($request);
        }

        if($userRole==2){
            return redirect()->route('store-manager');
        }

        if($userRole==3){
            return redirect()->route('warehouse-manager');
        }

        if($userRole==5){
            return redirect()->route('customer');
        }

        if($userRole==4){
            return redirect()->route('driver');
        }

        // Add this line to explicitly return a response for other roles
        return abort(403, 'Unauthorized'); // You can customize the error message and code
    }
}
