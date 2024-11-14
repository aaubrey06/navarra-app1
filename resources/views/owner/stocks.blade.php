@extends('layouts.owner_layout')

@section('contents')
    <div class="container my-4">


        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <table class="table table-striped table-bordered text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Product Name</th>
                                    <th>Current Quantity</th>
                                    <th>Reorder Point</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->rice_type }}</td>
                                        <td>{{ $product->current_quantity }}</td>
                                        <td>{{ $product->reorder_level }}</td>
                                        <td>
                                            @if ($product->current_quantity <= $product->reorder_level)
                                                <span class="badge bg-danger fs-6 p-2">Low Stock - Reorder Needed</span>
                                            @else
                                                <span class="badge bg-success fs-6 p-2">In Stock</span>
                                            @endif
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
@endsection
