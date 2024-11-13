@extends('layouts.owner_layout')

@section('contents')
    <div class="container mt-5">
        <h5 class="text-center">Warehouse Stock</h5>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mt-4 p-4 shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>Arrival Date</th>
                                    <th>Batch Code</th>
                                    <th>QR Code</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($warehouse_stocks as $stock)
                                    <tr>
                                        <td>{{ $products->firstWhere('product_id', $stock->product_id)->rice_type }}</td>
                                        <td>
                                            @if ($stock->quantity > 0)
                                                <span class="badge badge-success">{{ $stock->quantity }}</span>
                                            @else
                                                <span class="badge badge-danger">{{ $stock->quantity }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $stock->unit }}</td>
                                        <td>{{ \Carbon\Carbon::parse($stock->arrival_date)->format('Y-m-d') }}</td>
                                        <td>{{ $stock->batch_code }}</td>
                                        <td>
                                            <img src="{{ asset('path/to/qr_codes/' . $stock->qr_code) }}" alt="QR Code"
                                                style="width: 50px; height: 50px;">
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No warehouse stock records found.</td>
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
