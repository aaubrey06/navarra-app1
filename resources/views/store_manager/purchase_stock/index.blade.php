@extends('layouts.store-manager_layout')

@section('contents')
    <div class="container mt-5">
        <!-- Header with Add Request Button -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5>Stock Request List</h5>
            <a href="{{ route('store_manager.purchase_stock.create') }}" class="btn btn-primary">Add Request</a>
            <!-- Ensure this route exists -->
        </div>

        <!-- Stock Request List Table -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Supplier Name</th>
                        <th>Rice Type</th>
                        <th>Quantity Requested</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Requested On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchaseOrders as $order)
                        <tr>
                            <td>{{ $request->supplier_name }}</td>
                            <td>{{ $request->rice_type }}</td>
                            <td>{{ $request->quantity }}</td>
                            <td>₱{{ number_format($request->total_amount, 2) }}</td>
                            <td>{{ ucfirst($request->status) }}</td>
                            <td>{{ $request->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('viewStockRequest', $request->purchase_order_id) }}"
                                    class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('editStockRequest', $request->purchase_order_id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('deleteStockRequest', $request->purchase_order_id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
