@extends('layouts.owner_layout')

@section('contents')
    <div class="container mt-5">
        <h5 class="text-center">Purchase Stock List</h5>

        <div class="row justify-content-center">
            <div class="col-md-10"> <!-- Increased column width -->
                <div class="card mt-4 p-4 shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th style="width: 25%;">Supplier Name</th>
                                    <th style="width: 25%;">Product</th>
                                    <th style="width: 15%;">Quantity</th>
                                    <th style="width: 20%;">Total Price</th>
                                    <th style="width: 15%;">Status</th> <!-- New Status Column -->
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Sample Data --}}
                                @php
                                    $purchaseStocks = collect([
                                        (object) [
                                            'supplier_name' => 'Supplier A',
                                            'product' => (object) [
                                                'rice_type' => 'Long Grain Rice',
                                                'unit_price' => 50.0,
                                            ],
                                            'quantity' => 100,
                                            'total_price' => 5000.0,
                                            'status' => 'Completed', // Sample Status
                                        ],
                                        (object) [
                                            'supplier_name' => 'Supplier B',
                                            'product' => (object) [
                                                'rice_type' => 'Jasmine Rice',
                                                'unit_price' => 75.0,
                                            ],
                                            'quantity' => 50,
                                            'total_price' => 3750.0,
                                            'status' => 'Pending', // Sample Status
                                        ],
                                        (object) [
                                            'supplier_name' => 'Supplier C',
                                            'product' => (object) [
                                                'rice_type' => 'Basmati Rice',
                                                'unit_price' => 80.0,
                                            ],
                                            'quantity' => 20,
                                            'total_price' => 1600.0,
                                            'status' => 'Canceled', // Sample Status
                                        ],
                                    ]);
                                @endphp

                                @forelse ($purchaseStocks as $stock)
                                    <tr>
                                        <td>{{ $stock->supplier_name }}</td>
                                        <td>{{ $stock->product->rice_type }} -
                                            ₱{{ number_format($stock->product->unit_price, 2) }} per unit</td>
                                        <td>{{ $stock->quantity }}</td>
                                        <td>₱{{ number_format($stock->total_price, 2) }}</td>
                                        <td>{{ $stock->status }}</td> <!-- Display Status -->
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No purchase stock records found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
