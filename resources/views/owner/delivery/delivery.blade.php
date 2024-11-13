@extends('layouts.owner_layout')

@section('contents')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Delivery Overview</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover datatable">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Customer</th>
                                        <th>Rice Type</th>
                                        <th>Quantity (kg)</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Replace sample data with data from the database --}}
                                    @php
                                        $orders = collect([
                                            (object) [
                                                'user' => (object) ['name' => 'John Doe'],
                                                'rice_type' => 'Long Grain Rice',
                                                'quantity' => 5,
                                                'total' => 250.0,
                                                'status' => 'Delivered',
                                            ],
                                            (object) [
                                                'user' => (object) ['name' => 'Jane Smith'],
                                                'rice_type' => 'Jasmine Rice',
                                                'quantity' => 3,
                                                'total' => 150.0,
                                                'status' => 'Pending',
                                            ],
                                            (object) [
                                                'user' => (object) ['name' => 'Michael Johnson'],
                                                'rice_type' => 'Basmati Rice',
                                                'quantity' => 10,
                                                'total' => 500.0,
                                                'status' => 'Shipped',
                                            ],
                                            (object) [
                                                'user' => (object) ['name' => 'Alice Williams'],
                                                'rice_type' => 'Red Rice',
                                                'quantity' => 7,
                                                'total' => 350.0,
                                                'status' => 'Delivered',
                                            ],
                                        ]);
                                    @endphp

                                    @forelse ($orders as $order)
                                        <tr
                                            class="{{ $order->status == 'Delivered' ? 'table-success' : ($order->status == 'Shipped' ? 'table-info' : 'table-warning') }}">
                                            <td>{{ $order->user->name }}</td>
                                            <td>{{ $order->rice_type }}</td>
                                            <td>{{ $order->quantity }}</td>
                                            <td>₱{{ number_format($order->total, 2) }}</td>
                                            <td>
                                                <span
                                                    class="badge 
                                                    @if ($order->status == 'Delivered') bg-success 
                                                    @elseif($order->status == 'Shipped') 
                                                        bg-info 
                                                    @else 
                                                        bg-warning @endif">
                                                    {{ $order->status }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No delivery orders available.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
