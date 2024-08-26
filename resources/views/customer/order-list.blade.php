@extends('layouts.customer_layout')

@section('title', 'Order List')

@section('contents')

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order List</h5>

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Tracking No.</th>
                                    <th>Delivery Date</th>
                                    <th>Payment Status</th>
                                    <th>Order Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->tracking_no }}</td>
                                    <td>{{ $order->delivery_date }}</td>
                                    <td>{{ $order->payment_status }}</td>
                                    <td>{{ $order->order_status }}</td>
                                    <td>
                                        <form action="{{ route('order.cancel', $order->id) }}" method="POST" onsubmit="confirmCancellation(event, this)">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-danger mx-2">Cancel</button>
                                        </form>

                                        <a href="{{ route('customer.order-details', $order->id) }}" class="btn btn-success mx-2">View</a>

                                        @if ($order->order_status !== 'Delivered')
                                            <form action="{{ route('order.confirm', $order->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success mx-2">Confirm Delivery</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No orders found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                        <script>
                            function confirmCancellation(event, form) {
                                event.preventDefault();
                                if (confirm("Are you sure you want to cancel this order?")) {
                                    form.submit();
                                }
                            }
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
