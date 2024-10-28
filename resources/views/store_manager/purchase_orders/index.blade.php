@extends('layouts.store-manager_layout')

@section('content')
    <div class="container">
        <h1>Purchase Orders</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Order Number</th>
                    <th>Store</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchaseOrders as $purchaseOrder)
                    <tr>
                        <td>{{ $purchaseOrder->order_number }}</td>
                        <td>{{ $purchaseOrder->store->name }}</td> <!-- Assuming there's a store relationship -->
                        <td>{{ $purchaseOrder->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('purchase_order.show', $purchaseOrder->id) }}" class="btn btn-info">View</a>
                            <!-- Add other actions like edit or delete as needed -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('store_manager.purchase_order.create') }}" class="btn btn-primary">Create New Purchase Order</a>
    </div>
@endsection
