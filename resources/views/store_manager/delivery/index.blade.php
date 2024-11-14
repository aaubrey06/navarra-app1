@extends('layouts.store-manager_layout')

@section('contents')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Delivery List</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Customer</th>
                                        <th>Rice Type</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Driver</th>
                                        <th>Vehicle</th>
                                        <th>Status</th>
                                        <th>Delivery Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Sample Data --}}
                                    @php
                                        $deliveries = collect([
                                            (object) [
                                                'order' => (object) [
                                                    'user' => (object) ['name' => 'John Doe'],
                                                    'rice_type' => 'Long Grain Rice',
                                                    'quantity' => 5,
                                                    'total' => '₱25000.00',
                                                ],
                                                'driver' => (object) ['name' => 'Mark Johnson'],
                                                'vehicle' => (object) ['model' => 'Toyota Hilux'],
                                                'deliveryStatus' => (object) ['status' => 'Pending'],
                                                'delivery_address' => '123 Main St, City, Country',
                                            ],
                                            (object) [
                                                'order' => (object) [
                                                    'user' => (object) ['name' => 'Jane Smith'],
                                                    'rice_type' => 'Jasmine Rice',
                                                    'quantity' => 3,
                                                    'total' => '₱18000.00',
                                                ],
                                                'driver' => (object) ['name' => 'Sarah Williams'],
                                                'vehicle' => (object) ['model' => 'Mitsubishi L200'],
                                                'deliveryStatus' => (object) ['status' => 'Delivered'],
                                                'delivery_address' => '456 Oak St, Town, Country',
                                            ],
                                            (object) [
                                                'order' => (object) [
                                                    'user' => (object) ['name' => 'Alice Johnson'],
                                                    'rice_type' => 'Brown Rice',
                                                    'quantity' => 2,
                                                    'total' => '₱12000.00',
                                                ],
                                                'driver' => (object) ['name' => 'Chris Green'],
                                                'vehicle' => (object) ['model' => 'Ford Ranger'],
                                                'deliveryStatus' => (object) ['status' => 'Cancelled'],
                                                'delivery_address' => '789 Pine St, Village, Country',
                                            ],
                                        ]);
                                    @endphp

                                    @foreach ($deliveries as $delivery)
                                        <tr>
                                            <td>{{ $delivery->order->user->name }}</td>
                                            <td>{{ $delivery->order->rice_type }}</td>
                                            <td>{{ $delivery->order->quantity }}</td>
                                            <td>{{ $delivery->order->total }}</td>
                                            <td>{{ $delivery->driver->name }}</td>
                                            <td>{{ $delivery->vehicle->model }}</td>
                                            <td>
                                                <span
                                                    class="badge 
                                                    {{ $delivery->deliveryStatus->status === 'Delivered'
                                                        ? 'bg-success'
                                                        : ($delivery->deliveryStatus->status === 'Pending'
                                                            ? 'bg-warning'
                                                            : 'bg-danger') }}">
                                                    {{ $delivery->deliveryStatus->status }}
                                                </span>
                                            </td>
                                            <td>{{ $delivery->delivery_address }}</td>
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
