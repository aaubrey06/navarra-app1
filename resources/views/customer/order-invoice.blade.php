<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $order->order_id }}</title>
    <style>
        /* For Layout */
    </style>
</head>
<body>
    <h1>Invoice for Order #{{ $order->order_id }}</h1>
    <p><strong>Tracking No.:</strong> {{ $order->tracking_no }}</p>
    <p><strong>Delivery Date:</strong> {{ $order->delivery_date }}</p>
    <p><strong>Payment Status:</strong> {{ $order->payment_status }}</p>
    <p><strong>Order Status:</strong> {{ $order->order_status }}</p>
    <p><strong>Delivery Option:</strong> {{ $order->delivery_option }}</p>

    <h3>Items:</h3>
    <table width="100%">
        <thead>
            <tr>
                <th>Rice Type</th>
                <th>Unit</th>
                <th>Selling Price</th>
                <th>Quantity</th>
                <th>Total Selling Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderDetails as $item)
                <tr>
                    <td>{{ $item->rice_type }}</td>
                    <td>{{ $item->unit }}</td>
                    <td>{{ $item->selling_price }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->total_selling_price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Total Amount: ${{ number_format($order->orderDetails->sum('total_selling_price'), 2) }}</h3>

    <h3>Delivery Address:</h3>
    <p>{{ $user->first_name }} {{ $user->last_name }}</p>
    <p>{{ $customer->phone }}</p>
    <p>{{ $customer->barangay }}, {{ $customer->city }},
         {{ $customer->province }}, {{ $customer->region }}</p>
</body>
</html>