@extends('layouts.store-manager_layout')

@section('contents')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-center">In-Store Sales</h4>
            <a href="{{ route('store_manager.walk-in.add') }}" class="btn btn-primary">
                <i class="bi bi-plus"></i> Add Sale
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover text-center align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Sale ID</th>
                        <th>Product Name</th>
                        <th>Quantity Sold</th>
                        <th>Total Price</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sales as $sale)
                        <tr>
                            <td>{{ $sale->sale_id }}</td>
                            <td>{{ $sale->product->rice_type }}</td>
                            <td>{{ $sale->quantity_sold }}</td>
                            <td>₱{{ number_format($sale->total_price, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($sale->sale_date)->format('Y-m-d H:i:s') }}</td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No sales recorded.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
