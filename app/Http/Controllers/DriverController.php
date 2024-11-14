<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class DriverController extends Controller
{
    public function view()
    {
        return view('driver.routes');
    }

    public function orders()
    {
        return view('driver.orders');
    }

    public function schedule()
    {
        return view('driver.schedule');
    }
}