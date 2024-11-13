@extends('layouts.store-manager_layout')

@section('contents')
    <h1>In-Store Orders</h1>

    <div class="mb-3 text-right">
        <a href="{{ route('store_manager.in-store-orders.create') }}" class="btn btn-primary">Add Order</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Rice Type</th>
                    <th>Quantity</th>
                    <th>Unit</th>
                    <th>Price</th>
                    <th>Location</th>
                    <th>Phone Number</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Actions</th> <!-- Actions column for edit and delete -->
                </tr>
            </thead>
            <tbody>
                @foreach ($orderstore as $order)
                    <tr>
                        <td>{{ $order->order_id }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->product->rice_type }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->unit }}</td>
                        <td>₱{{ number_format($order->price, 2) }}</td>
                        <td>{{ $order->location ?? 'N/A' }}</td>
                        <td>{{ $order->phone_number }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>
                            <!-- Display current status -->
                            <form action="{{ route('store_manager.in-store-orders.update-status', $order->order_id) }}"
                                method="POST" class="form-inline">
                                @csrf
                                @method('PUT')

                                <!-- Status Dropdown for Pending, Shipped, Delivered -->
                                <select name="order_status" class="form-control" onchange="this.form.submit()">
                                    <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>
                                        Shipped</option>
                                    <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>
                                        Delivered</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <!-- Edit Button -->
                            <a href="{{ route('store_manager.in-store-orders.edit', $order->order_id) }}"
                                class="btn btn-warning btn-sm">Edit</a>

                            <!-- Delete Button (Form to handle delete) -->
                            <form action="{{ route('store_manager.in-store-orders.destroy', $order->order_id) }}"
                                method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this order?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
