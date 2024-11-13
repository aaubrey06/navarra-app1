@extends('layouts.owner_layout')

@section('contents')
    <h3 class="mb-4">Trucks</h3>

    <!-- Add Truck Button -->
    <div class="mb-3">
        <a href="{{ route('owner.truck.create') }}" class="btn btn-primary">Add Truck</a>
    </div>

    <!-- Trucks Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Trucks List</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>License Plate</th>
                        <th>Model</th>
                        <th>Capacity (kg)</th>
                        <th>Color</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trucks as $truck)
                        <tr>
                            <td>{{ $truck->truck_id }}</td> <!-- Updated to use truck_id -->
                            <td>{{ $truck->license_plate }}</td> <!-- Updated column for license plate -->
                            <td>{{ $truck->model }}</td>
                            <td>{{ $truck->capacity ?? 'N/A' }}</td> <!-- Displays 'N/A' if capacity is null -->
                            <td>{{ $truck->color ?? 'N/A' }}</td> <!-- Displays 'N/A' if color is null -->
                            <td>

                                <a href="{{ route('owner.truck.edit', $truck->truck_id) }}"
                                    class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('owner.truck.destroy', $truck->truck_id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($trucks->isEmpty())
                <div class="alert alert-warning" role="alert">
                    No trucks available.
                </div>
            @endif
        </div>
    </div>
@endsection
