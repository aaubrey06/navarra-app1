<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DriverController extends Controller
{
    public function view(): View
    {
        return view('driver.routes');
    }

    public function orders(): View
    {
        return view('driver.orders');
    }

    public function schedule(): View
    {
        return view('driver.schedule');
    }
}