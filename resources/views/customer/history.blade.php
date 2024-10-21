@extends('layouts.customer_layout')

@section('title', 'History')

@section('contents')

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">History</h5>

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Tracking No.</th>
                                    <th>Date Delivered</th>
                                    <th>Order Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dynamic product rows will go here -->
                                @forelse ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->tracking_no }}</td>
                                        <td>{{ $order->delivery_date }}</td>
                                        <td>{{ $order->order_status }}</td>
                                        <td>
                                            <a href="{{ route('order.history.details', ['id' => $order->id]) }}" class="btn btn-success mx-2">View Details</a>
                                            {{-- <button type="submit" class="btn btn-danger">Remove</button> --}}

                                            <form action="{{ route('customer.history.destroy', $order->id) }}" method="POST" class="d-inline-block" onsubmit="return confirmRemoval()">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Remove</button>
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No order history found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                        <script>
                            function confirmRemoval() {
                                return confirm('Are you sure you want to remove this order?');
                            }
                        </script>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
