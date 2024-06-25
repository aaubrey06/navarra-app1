<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role == 'super_admin') {
            return $next($request); // Allow Super Admin to access the requested route
        }

        // If the user is not a Super Admin, abort with a 403 error
        return abort(403, 'Unauthorized'); // You can customize the error message and code
    }
}
