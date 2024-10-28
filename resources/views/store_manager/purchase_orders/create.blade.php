@extends('layouts.store-manager_layout')

@section('content')
    <div class="container">
        <h1>Create Purchase Order</h1>

        <form action="{{ route('purchase_orders.store') }}" method="POST">
            @csrf

            <!-- Store Branch -->
            <div class="form-group">
                <label for="store">Branch Name</label>
                <input type="text" class="form-control" id="store" value="{{ $store->name }}" readonly>
            </div>

            <!-- Purchase Order Number (Auto-generated) -->
            <div class="form-group">
                <label for="order_number">Purchase Order Number</label>
                <input type="text" class="form-control" id="order_number" value="Auto-generated upon submission"
                    readonly>
            </div>

            <!-- Products and Quantities -->
            <div class="form-group">
                <label for="products">Products</label>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>
                                    <input type="number" name="products[{{ $product->id }}][quantity]"
                                        class="form-control" min="1">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <button type="submit" class="btn btn-primary">Submit Purchase Order</button>
        </form>
    </div>
@endsection
