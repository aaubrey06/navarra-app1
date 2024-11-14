@extends('layouts.owner_layout')
@section('contents')
    <div class="container mt-4">
        <h1>Order List</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Product ID</th>
                    <th>Quantity</th>
                    <th>Unit</th>
                    <th>Price</th>
                    <th>Method</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Delivery Date</th>
                    <th>Payment Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->order_id }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->product_id }}</td>
                        <td>{{ $order->orderstore_quantity }}</td>
                        <td>{{ $order->unit }}</td>
                        <td>${{ number_format($order->price, 2) }}</td>
                        <td>{{ $order->orderstore_method }}</td>
                        <td>{{ ucfirst($order->orderstore_status) }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->orderstore_order_date)->format('M d, Y') }}</td>
                        <td>
                            @if ($order->delivery_date)
                                {{ \Carbon\Carbon::parse($order->delivery_date)->format('M d, Y') }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ ucfirst($order->payment_status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
