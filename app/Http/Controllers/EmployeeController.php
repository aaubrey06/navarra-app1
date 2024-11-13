<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    // Display a list of employees
    public function index()
    {
        $employees = Employee::all(); 
        return view('owner.employee.index', compact('employees'));
    }

    public function create()
    {
        return view('owner.employee.create');
    }

    public function store(Request $request)
    {
       
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone_number' => 'nullable|string|max:15',
            'gender' => 'nullable|string|max:10',
            'dob' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'region' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'nationality' => 'nullable|string|max:100',
            'ssn' => 'nullable|string|max:20',
        ]);

        
        Employee::create([
            'name' => $request->name,
            'position' => $request->position,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'address' => $request->address,
            'city' => $request->city,
            'province' => $request->province,
            'region' => $request->region,
            'postal_code' => $request->postal_code,
            'nationality' => $request->nationality,
            'ssn' => $request->ssn,
        ]);

        
        return redirect()->route('owner.employee.index')->with('success', 'Employee added successfully.');
    }

    public function edit($employee_id)
{
    $employee = Employee::findOrFail($employee_id);

    return view('owner.employee.edit', compact('employee'));
}

public function update(Request $request, $employee_id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'position' => 'required|string|max:255',
        'email' => 'required|email|unique:employees,email,' . $employee_id . ',employee_id',
        'phone_number' => 'nullable|string|max:15',
        'gender' => 'nullable|string|max:10',
        'dob' => 'nullable|date',
        'address' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:100',
        'province' => 'nullable|string|max:100',
        'region' => 'nullable|string|max:100',
        'postal_code' => 'nullable|string|max:20',
        'nationality' => 'nullable|string|max:100',
        'ssn' => 'nullable|string|max:20',
    ]);

    $employee = Employee::findOrFail($employee_id);

    $employee->update([
        'name' => $request->name,
        'position' => $request->position,
        'email' => $request->email,
        'phone_number' => $request->phone_number,
        'gender' => $request->gender,
        'dob' => $request->dob,
        'address' => $request->address,
        'city' => $request->city,
        'province' => $request->province,
        'region' => $request->region,
        'postal_code' => $request->postal_code,
        'nationality' => $request->nationality,
        'ssn' => $request->ssn,
    ]);

    return redirect()->route('owner.employee.index')->with('success', 'Employee updated successfully.');
}


public function destroy($employee_id)
{
    $employee = Employee::find($employee_id);

    if ($employee) {
        $employee->delete();
        return redirect()->route('owner.employee.index')->with('success', 'Employee deleted successfully.');
    }

    return redirect()->route('owner.employee.index')->with('error', 'Employee not found.');
}

}
