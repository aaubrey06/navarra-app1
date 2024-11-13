@extends('layouts.store-manager_layout')

@section('contents')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Product List</h1>

        <!-- Add Product Button -->
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('store_manager.products.create') }}" class="btn btn-success">Add Product</a>
        </div>

        <!-- Product Table -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Unit</th>
                        <th>Unit Price</th>
                        <th>Selling Price</th>
                        <th>Target Level</th>
                        <th>Reorder Level</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->rice_type }}"
                                        class="img-fluid" style="max-width: 80px; max-height: 80px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('images/no-image.png') }}" alt="No Image" class="img-fluid"
                                        style="max-width: 80px; max-height: 80px;">
                                @endif
                            </td>
                            <td>{{ $product->rice_type }}</td>
                            <td>{{ $product->unit }}</td>
                            <td>₱{{ number_format($product->unit_price, 2) }}</td>
                            <td>₱{{ number_format($product->selling_price, 2) }}</td>
                            <td>{{ $product->target_level }}</td>
                            <td>{{ $product->reorder_level }}</td>
                            <td class="d-flex justify-content-between">
                                <!-- Edit button -->
                                <a href="{{ route('store_manager.products.edit', $product) }}"
                                    class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top"
                                    title="Edit Product">
                                    Edit
                                </a>

                                <!-- Delete button -->
                                <form action="{{ route('store_manager.products.destroy', $product) }}" method="POST"
                                    style="display: inline;"
                                    onsubmit="return confirm('Are you sure you want to delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip"
                                        data-placement="top" title="Delete Product">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Initialize tooltips (optional) -->
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
