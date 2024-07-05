<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function employee(): View
    {
        $employees = Employee::all();
        return view('owner.employee', compact('employees'));
    }

    // public function show($id)
    // {
    //     $employee = Employee::find($id);
    //     return view('owner.employee.show', compact('employee'));
    // }
}
