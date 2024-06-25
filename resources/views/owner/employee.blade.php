@extends('layouts.owner_layout')

@section('content')
    <div class="container">
        <h1>Employees</h1>
        {{-- <a href="{{ route('employee.create') }}" class="btn btn-primary">Add Employee</a> --}}
        <a href="" class="btn btn-primary">Add Employee</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->position }}</td>
                        <td>{{ $employee->salary }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
