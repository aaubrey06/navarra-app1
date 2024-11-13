@extends('layouts.store-manager_layout')

@section('contents')
    <div class="container mt-5">
        <!-- Header with Add Request Button -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5>Stock Request List</h5>
            <a href="" class="btn btn-primary">Add Request</a>
        </div>

        <!-- Stock Request List Table -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity Requested</th>
                        <th>Reorder Level</th>
                        <th>Status</th>
                        <th>Requested On</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @forelse ($stockRequests as $request)
                        <tr>
                            <td>{{ $request->product->rice_type }}</td>
                            <td>{{ $request->quantity }}</td>
                            <td>{{ $request->product->reorder_level }}</td>
                            <td>{{ $request->status }}</td>
                            <td>{{ $request->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No stock requests found.</td>
                        </tr>
                    @endforelse --}}
                </tbody>
            </table>
        </div>
    </div>
@endsection
