@extends('layouts.customer_layout')

@section('title', 'Order Details')

@section('contents')

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order Details</h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Rice type</th>
                                    <th>Unit</th>
                                    <th>Selling Price</th>
                                    <th>Quantity</th>
                                    <th>Total Selling Price</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orderDetails as $item)
                                <tr>
                                    <td><!--Image of the Product--></td>
                                    <td>{{ $item['rice_type'] }}</td>
                                    <td>{{ $item['unit'] }}</td>
                                    <td>{{ $item['selling_price'] }}</td>
                                    <td>{{ $item['quantity'] }}</td>
                                    <td>{{ $item['total_selling_price'] }}</td>
                                </tr>

                                <!-- @php
                                    $totalPrice += $item['total_selling_price'];
                                @endphp -->

                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No products added yet</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                        <div class="card-body">
                            <h5>Order ID: {{ $order->id }}</h5>
                            <h5>Tracking No.: {{ $order->tracking_no }}</h5>
                            <h5>Delivery Date: {{ $order->delivery_date }}</h5>
                            <h5>Payment Status: {{ $order->payment_status }}</h5>
                            <h5>Order Status: {{ $order->order_status }}</h5>
                            <h5>Delivery Option: <!-- Insert Delivery Option Here --></h5>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Delivery Address</h5>
                            <h5>Grace Poe</h5>
                            <h5>09123456789</h5>
                            <h5>Iloilo City, Iloilo</h5>
                            <h5>5800</h5>
                        </div>

                        <!-- <form action="{{ route('cart.placeOrder') }}" method="POST">
                            @csrf
                            <div class="text-end">
                                <h5>Total: ${{ number_format($totalPrice, 2) }}</h5>
                                <a href="{{ route('cart') }}" class="btn btn-success mx-2">Edit Order</a>
                                <button type="submit" class="btn btn-success mx-2">Place Order</button>
                            </div>
                        </form> -->

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
