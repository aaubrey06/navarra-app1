<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Store;
use Carbon\Carbon;

class StoreController extends Controller
{
    public function index(): View
    {
        $stores = Store::all(); 
        return view('owner.store.index', compact('stores'));    }
    public function create(): View
    {
        return view('owner.store.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'store_name' => 'required|string|max:45',
            'store_location' => 'required|string|max:45',
            'store_latitude' => 'required|string|max:45',
            'store_longitude' => 'required|string|max:45',
            'contact' => 'nullable|string|max:15',
            'working_hours' => 'nullable|string|max:50',
            'status' => 'nullable|in:open,closed',
        ]);

        $currentTime = Carbon::now();

        $workingHours = explode(' - ', $request->working_hours);

        if (count($workingHours) == 2) {
            // Parse start and end times
            $startTime = Carbon::createFromFormat('h:i A', $workingHours[0]);
            $endTime = Carbon::createFromFormat('h:i A', $workingHours[1]);

            // If the current time is outside working hours, set status to "closed"
            if ($currentTime->lt($startTime) || $currentTime->gt($endTime)) {
                $status = 'closed';
            } else {
                $status = 'open';
            }
        } else {
            // If working hours are not valid, consider the store as closed
            $status = 'closed';
        }

        // Create the store record in the database
        Store::create([
            'store_name' => $request->store_name,
            'store_location' => $request->store_location,
            'store_latitude' => $request->store_latitude,
            'store_longitude' => $request->store_longitude,
            'contact' => $request->contact,
            'working_hours' => $request->working_hours,
            'status' => $status, // Set the status based on the working hours check
        ]);

        // Redirect or respond
        return redirect()->route('owner.store.index')->with('success', 'Store added successfully!');
    }

    public function edit($store_id)
{
    // Fetch the store by its store_id
    $store = Store::findOrFail($store_id);

    // Return the edit view with the store data
    return view('owner.store.edit', compact('store'));
}
// Method to update store details
public function update(Request $request, $id)
{
    // Validate incoming data
    $request->validate([
        'store_name' => 'required|string|max:255',
        'store_location' => 'required|string|max:255',
        'contact' => 'nullable|string|max:255',
        'working_hours' => 'nullable|string|max:255',
        'status' => 'required|string|in:open,closed',
    ]);

    // Find the store by ID and update its details
    $store = Store::findOrFail($id);
    $store->update([
        'store_name' => $request->store_name,
        'store_location' => $request->store_location,
        'contact' => $request->contact,
        'working_hours' => $request->working_hours,
        'status' => $request->status,
    ]);

    
    // Redirect back to the stores list with success message
    return redirect()->route('owner.store.index')->with('success', 'Store updated successfully.');
}
public function destroy($store_id)
{
    // Find the store by store_id
    $store = Store::findOrFail($store_id);

    // Delete the store
    $store->delete();

    // Redirect to the store list with a success message
    return redirect()->route('owner.store.index')->with('success', 'Store deleted successfully.');
}

}
