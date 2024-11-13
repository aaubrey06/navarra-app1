@extends('layouts.owner_layout')

@section('contents')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-center">Order List</h1>

        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Method</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Customer Location</th>
                        <th>Change Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->customer->name }}</td>
                            <td>{{ $order->product->rice_type }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ $order->product->unit }}</td>
                            <td>{{ ucfirst($order->method) }}</td>
                            <td>{{ $order->order_date }}</td>
                            <td>{{ ucfirst($order->orderStatus->status) }}</td>

                            <td>
                                @if ($order->method == 'delivery')
                                    <!-- Display customer location for delivery orders -->
                                    @if ($order->customer->address)
                                        <p>
                                            {{ $order->customer->address }}<br>
                                            {{ $order->customer->barangay }}, {{ $order->customer->city }}<br>
                                            {{ $order->customer->province }}, {{ $order->customer->region }}<br>
                                            @if ($order->customer->latitude && $order->customer->longitude)
                                                (Lat: {{ $order->customer->latitude }}, Long:
                                                {{ $order->customer->longitude }})
                                            @endif
                                        </p>
                                    @else
                                        Address not available
                                    @endif
                                @elseif ($order->method == 'pickup')
                                    <!-- For in-store pickup orders, no location -->
                                    No address (In-store Pickup)
                                @elseif ($order->method == 'in-store' && $order->quantity >= 20)
                                    <!-- If it's an in-store order and the quantity is >= 20, allow delivery -->
                                    <p>Eligible for delivery</p>
                                @else
                                    No address (In-store order)
                                @endif
                            </td>

                            <td>
                                {{-- Change Status --}}
                                <form action="{{ route('store_manager.orders.updateStatus', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-select" onchange="this.form.submit()">
                                        <option value="1" {{ $order->orderStatus->id == 1 ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="2" {{ $order->orderStatus->id == 2 ? 'selected' : '' }}>Shipped
                                        </option>
                                        <option value="3" {{ $order->orderStatus->id == 3 ? 'selected' : '' }}>
                                            Delivered</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $orders->links() }} <!-- Pagination links -->
        </div> --}}
    </div>
@endsection
