@extends('layouts.store-manager_layout')

@section('contents')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header text-center bg-primary text-white">
                    <h3>Add Stock</h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('store_manager.stocks.store') }}" method="POST">
                        @csrf

                        <!-- Product Selection -->
                        <div class="mb-4">
                            <label for="product_id" class="form-label fw-bold">Product Name</label>
                            <select name="product_id" id="product_id" class="form-select" required>
                                <option value="" disabled selected>Select Product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->product_id }}">{{ $product->rice_type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Quantity to Add -->
                        <div class="mb-4">
                            <label for="current_quantity" class="form-label fw-bold">Current Quantity to Add</label>
                            <input type="number" name="current_quantity" id="current_quantity" class="form-control"
                                placeholder="Enter quantity" min="1" required>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary w-100 fw-bold">Add Stock</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
