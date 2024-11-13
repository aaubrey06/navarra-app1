@extends('layouts.store-manager_layout')

@section('contents')
    <div class="container">

        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->rice_type }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->orderStatus->status_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
