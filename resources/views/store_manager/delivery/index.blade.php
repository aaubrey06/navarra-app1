@extends('layouts.store-manager_layout')

@section('contents')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Delivery</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover datatable">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Customer</th>
                                        <th>Rice Type</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Sample Data --}}
                                    @php
                                        $orders = collect([
                                            (object) [
                                                'user' => (object) ['name' => 'John Doe'],
                                                'rice_type' => 'Long Grain Rice',
                                                'quantity' => 5,
                                                'total' => '₱250.00',
                                                'status' => 'Pending',
                                            ],
                                            (object) [
                                                'user' => (object) ['name' => 'Jane Smith'],
                                                'rice_type' => 'Jasmine Rice',
                                                'quantity' => 3,
                                                'total' => '₱180.00',
                                                'status' => 'Delivered',
                                            ],
                                            (object) [
                                                'user' => (object) ['name' => 'Alice Johnson'],
                                                'rice_type' => 'Brown Rice',
                                                'quantity' => 2,
                                                'total' => '₱120.00',
                                                'status' => 'Cancelled',
                                            ],
                                        ]);
                                    @endphp

                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->user->name }}</td>
                                            <td>{{ $order->rice_type }}</td>
                                            <td>{{ $order->quantity }}</td>
                                            <td>{{ $order->total }}</td>
                                            <td>
                                                <span
                                                    class="badge 
                                                    {{ $order->status === 'Delivered' ? 'bg-success' : ($order->status === 'Pending' ? 'bg-warning' : 'bg-danger') }}">
                                                    {{ $order->status }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
