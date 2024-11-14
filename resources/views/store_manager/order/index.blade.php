@extends('layouts.store-manager_layout')

@section('contents')
    <h1>Orders</h1>

    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th style="padding: 8px; border: 1px solid #ddd;">ID</th>
                <th style="padding: 8px; border: 1px solid #ddd;">Order Date</th>
                <th style="padding: 8px; border: 1px solid #ddd;">Customer Name</th>
                <th style="padding: 8px; border: 1px solid #ddd;">Rice Type</th>
                <th style="padding: 8px; border: 1px solid #ddd;">Quantity</th>
                <th style="padding: 8px; border: 1px solid #ddd;">Total</th>
                <th style="padding: 8px; border: 1px solid #ddd;">Status</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 8px;">{{ $order->order_id }}</td>
                    <td style="padding: 8px;">
                        {{ $order->created_at ? $order->created_at->format('Y-m-d') : 'N/A' }}
                    </td>
                    <td style="padding: 8px;">{{ $order->customer ? $order->customer->Customer_name : 'N/A' }}</td>
                    <td style="padding: 8px;">
                        @foreach ($order->orderDetails as $orderDetail)
                            {{ $orderDetail->rice_type }} <br>
                        @endforeach
                    </td>
                    <td style="padding: 8px;">
                        @foreach ($order->orderDetails as $orderDetail)
                            {{ $orderDetail->quantity }} <br>
                        @endforeach
                    </td>
                    <td style="padding: 8px;">
                        @foreach ($order->orderDetails as $orderDetail)
                            {{ $orderDetail->total_selling_price }} <br>
                        @endforeach
                    </td>
                    <td style="padding: 8px;">{{ $order->orderStatus->status_name ?? 'N/A' }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>






    {{-- 
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Order Date</th>
                <th>Customer Name</th>
                <th>Rice Type</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->order_date }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->rice_type }}</td>
                    <td>{{ $order->total }}</td>
                    <td>{{ $order->status }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}
@endsection
