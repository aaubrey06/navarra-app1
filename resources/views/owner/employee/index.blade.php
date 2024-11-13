@extends('layouts.owner_layout')

@section('contents')
    <h4 class="mb-4">Employees</h4>

    <!-- Add Employee Button -->
    <div class="mb-3">
        <a href="{{ route('owner.employee.create') }}" class="btn btn-primary">Add Employee</a>
    </div>

    <!-- Employees Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Employees List</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Gender</th>
                        <th>Date of Birth</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Province</th>
                        <th>Region</th>
                        <th>Postal Code</th>
                        <th>Nationality</th>
                        <th>SSN</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->employee_id }}</td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->position ?? 'N/A' }}</td>
                            <td>{{ $employee->gender ?? 'N/A' }}</td>
                            <td>{{ $employee->dob ? \Carbon\Carbon::parse($employee->dob)->format('d-m-Y') : 'N/A' }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->phone_number ?? 'N/A' }}</td>
                            <td>{{ $employee->address ?? 'N/A' }}</td>
                            <td>{{ $employee->city ?? 'N/A' }}</td>
                            <td>{{ $employee->province ?? 'N/A' }}</td>
                            <td>{{ $employee->region ?? 'N/A' }}</td>
                            <td>{{ $employee->postal_code ?? 'N/A' }}</td>
                            <td>{{ $employee->nationality ?? 'N/A' }}</td>
                            <td>{{ $employee->ssn ?? 'N/A' }}</td>
                            <td>
                                <!-- Edit Button -->
                                <a href="{{ route('owner.employee.edit', $employee->employee_id) }}"
                                    class="btn btn-sm btn-warning">Edit</a>

                                <!-- Delete Button -->
                                <form action="{{ route('owner.employee.destroy', $employee->employee_id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this employee?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if ($employees->isEmpty())
                <div class="alert alert-warning" role="alert">
                    No employees available.
                </div>
            @endif
        </div>
    </div>
@endsection
