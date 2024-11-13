<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    public function index()
    {
        $trucks = Truck::all(); 
        return view('owner.truck.index', compact('trucks'));
    }


    public function create()
    {
        return view('owner.truck.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'license_plate' => 'required|string|max:255|unique:trucks',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'capacity' => 'nullable|numeric',
            'color' => 'nullable|string|max:255',
        ]);

        Truck::create([
            'license_plate' => $request->license_plate,
            'model' => $request->model,
            'year' => $request->year,
            'capacity' => $request->capacity,
            'color' => $request->color,
        ]);

        return redirect()->route('owner.truck.index')->with('success', 'Truck added successfully.');
    }

    public function edit($truck_id)
    {
        $truck = Truck::where('truck_id', $truck_id)->firstOrFail();
        return view('owner.truck.edit', compact('truck'));
    }

    public function update(Request $request, $truck_id)
    {
        $request->validate([
            'license_plate' => 'required|string|max:255|unique:trucks,license_plate,' . $truck_id . ',truck_id',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'capacity' => 'nullable|numeric',
            'color' => 'nullable|string|max:255',
        ]);

        $truck = Truck::where('truck_id', $truck_id)->firstOrFail();
        $truck->update([
            'license_plate' => $request->license_plate,
            'model' => $request->model,
            'year' => $request->year,
            'capacity' => $request->capacity,
            'color' => $request->color,
        ]);

        return redirect()->route('owner.truck.index')->with('success', 'Truck updated successfully.');
    }

    public function destroy($truck_id)
    {
        $truck = Truck::where('truck_id', $truck_id)->firstOrFail();
        $truck->delete();

        return redirect()->route('owner.truck.index')->with('success', 'Truck deleted successfully.');
    }
    
}
