@extends('layouts.owner_layout')

@section('contents')
    <div class="container mt-5">
        <h5 class="text-center">Request Stock</h5>

        <div class="row justify-content-center">
            <div class="col-md-10"> <!-- Increased column size -->
                <div class="card mt-4 p-4 shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" style="font-size: 1.1rem; width: 100%;">
                            <thead class="table-primary">
                                <tr>
                                    <th style="width: 15%;">Request ID</th>
                                    <th style="width: 25%;">Supplier Name</th>
                                    <th style="width: 25%;">Product</th>
                                    <th style="width: 15%;">Quantity</th>
                                    <th style="width: 10%;">Status</th>
                                    <th style="width: 10%;">Requested On</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Sample Data --}}
                                @php
                                    $purchaseRequests = collect([
                                        (object) [
                                            'id' => 1,
                                            'supplier_name' => 'Supplier A',
                                            'product' => (object) [
                                                'rice_type' => 'Long Grain Rice',
                                            ],
                                            'quantity' => 100,
                                            'status' => 'approved',
                                            'created_at' => now()->subDays(2),
                                        ],
                                        (object) [
                                            'id' => 2,
                                            'supplier_name' => 'Supplier B',
                                            'product' => (object) [
                                                'rice_type' => 'Jasmine Rice',
                                            ],
                                            'quantity' => 50,
                                            'status' => 'pending',
                                            'created_at' => now()->subDays(1),
                                        ],
                                        (object) [
                                            'id' => 3,
                                            'supplier_name' => 'Supplier C',
                                            'product' => (object) [
                                                'rice_type' => 'Basmati Rice',
                                            ],
                                            'quantity' => 20,
                                            'status' => 'canceled',
                                            'created_at' => now()->subDays(5),
                                        ],
                                    ]);
                                @endphp

                                @forelse ($purchaseRequests as $request)
                                    <tr>
                                        <td>{{ $request->id }}</td>
                                        <td>{{ $request->supplier_name }}</td>
                                        <td>{{ $request->product->rice_type }}</td>
                                        <td>{{ $request->quantity }}</td>
                                        <td>
                                            <span
                                                class="badge 
                                                {{ $request->status === 'approved' ? 'bg-success' : ($request->status === 'pending' ? 'bg-warning' : 'bg-danger') }}">
                                                {{ ucfirst($request->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $request->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No purchase requests found.</td>
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
