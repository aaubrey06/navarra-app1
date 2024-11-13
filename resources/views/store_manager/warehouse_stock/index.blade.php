@extends('layouts.store-manager_layout')

@section('contents')
    <h5 class="mb-4">Warehouse Stock</h5>


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
                @foreach ($warehouse_stocks as $stock)
                    <tr>
                        <td>
                            <span class="font-weight-bold">
                                {{ $products->firstWhere('product_id', $stock->product_id)->rice_type }}
                            </span>
                        </td>

                        <td>
                            @if ($stock->quantity > 0)
                                <span class="badge badge-success">{{ $stock->quantity }}</span>
                            @else
                                <span class="badge badge-danger">{{ $stock->quantity }}</span>
                            @endif
                        </td>

                        <td>{{ $stock->unit }}</td>

                        <td>
                            {{ \Carbon\Carbon::parse($stock->arrival_date)->format('Y-m-d') }}
                        </td>

                        <td>
                            <span class="badge badge-primary">{{ $stock->batch_code }}</span>
                        </td>

                        <td>
                            <a href="" class="btn btn-info btn-sm" target="_blank" title="View QR Code">
                                <i class="fas fa-qrcode"></i> View QR
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
