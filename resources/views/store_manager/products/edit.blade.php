@extends('layouts.store-manager_layout')

@section('contents')
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card p-4" style="width: 100%; max-width: 600px;">
            <h1 class="text-center mb-4">Edit Product</h1>

            <form action="{{ route('store_manager.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Product Name -->
                <div class="form-group mb-3">
                    <label for="rice_type">Product Name</label>
                    <input type="text" class="form-control @error('rice_type') is-invalid @enderror" id="rice_type"
                        name="rice_type" value="{{ old('rice_type', $product->rice_type) }}" required>
                    @error('rice_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Unit -->
                <div class="form-group mb-3">
                    <label for="unit">Unit</label>
                    <select class="form-select @error('unit') is-invalid @enderror" id="unit" name="unit" required>
                        <option value="5" {{ old('unit', $product->unit) == '5' ? 'selected' : '' }}>5</option>
                        <option value="10" {{ old('unit', $product->unit) == '10' ? 'selected' : '' }}>10</option>
                        <option value="25" {{ old('unit', $product->unit) == '25' ? 'selected' : '' }}>25</option>
                        <option value="50" {{ old('unit', $product->unit) == '50' ? 'selected' : '' }}>50</option>
                    </select>
                    @error('unit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Unit Price -->
                <div class="form-group mb-3">
                    <label for="unit_price">Unit Price</label>
                    <input type="number" class="form-control @error('unit_price') is-invalid @enderror" id="unit_price"
                        name="unit_price" value="{{ old('unit_price', $product->unit_price) }}" required step="0.01">
                    @error('unit_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Selling Price -->
                <div class="form-group mb-3">
                    <label for="selling_price">Selling Price</label>
                    <input type="number" class="form-control @error('selling_price') is-invalid @enderror"
                        id="selling_price" name="selling_price" value="{{ old('selling_price', $product->selling_price) }}"
                        required step="0.01">
                    @error('selling_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Target Level -->
                <div class="form-group mb-3">
                    <label for="target_level">Target Level</label>
                    <input type="number" class="form-control @error('target_level') is-invalid @enderror" id="target_level"
                        name="target_level" value="{{ old('target_level', $product->target_level) }}" required>
                    @error('target_level')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Reorder Level -->
                <div class="form-group mb-3">
                    <label for="reorder_level">Reorder Level</label>
                    <input type="number" class="form-control @error('reorder_level') is-invalid @enderror"
                        id="reorder_level" name="reorder_level" value="{{ old('reorder_level', $product->reorder_level) }}"
                        required>
                    @error('reorder_level')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Product Image -->
                <div class="form-group mb-3">
                    <label for="image">Product Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                        name="image">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image Preview (Optional) -->
                @if ($product->image)
                    <div class="form-group mb-3">
                        <label>Current Image</label>
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image" class="img-fluid"
                            style="max-width: 200px;">
                    </div>
                @endif

                <!-- Submit Button -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success">Update Product</button>
                </div>
            </form>
        </div>
    </div>
@endsection
