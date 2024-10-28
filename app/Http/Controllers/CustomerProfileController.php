<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class CustomerProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Assuming you are using Laravel's Auth
        return view('customer.customer-profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user(); // Get the authenticated user

        // Validate inputs
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:15',
            'region' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'barangay' => 'required|string|max:100',
        ]);


        // Update User's basic information
        $user->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
        ]);

        // Save or update the Customer data
        $customer = \App\Models\Customer::updateOrCreate(
            ['user_id' => $user->id],  // Match by user_id
            [
                'region' => $validated['region'],
                'province' => $validated['province'],
                'city' => $validated['city'],
                'barangay' => $validated['barangay'],
                'address' => $request->input('address'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
            ]
        );


        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function editProfile()
    {
        // Retrieve the currently authenticated user
        $user = Auth::user();

        // Pass the user data to the view
        return view('customer.customer-edit-profile', compact('user'));
    }
}

