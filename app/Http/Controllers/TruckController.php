<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Truck;
use Illuminate\View\View;

class TruckController extends Controller
{
    public function index()
    {
        $trucks = Truck::all();
        return view('owner.truck', compact('trucks'));
    }

    // public function show($id)
    // {
    //     $truck = Truck::find($id);
    //     return view('owner.truck.show', compact('truck'));
    // }
}

