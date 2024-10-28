<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerAccountSettingController extends Controller
{
    public function index(): View
    {
        return view('customer.customer-account-settings');
    }

}
