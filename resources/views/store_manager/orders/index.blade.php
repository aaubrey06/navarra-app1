@extends('layouts.store-manager_layout')

@section('content')
    <h1>Order List</h1>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Order Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paginatedOrders as $order)
                <tr>
                    <td>{{ $order['id'] }}</td>
                    <td>{{ $order['customer_name'] }}</td>
                    <td>{{ $order['order_date'] }}</td>
                    <td>{{ $order['status'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $paginatedOrders->links() }}
@endsection
