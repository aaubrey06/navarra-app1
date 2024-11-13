@extends('layouts.store-manager_layout')

@section('contents')
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card p-4" style="width: 100%; max-width: 600px;">
            <h1 class="text-center mb-4">Add New Product</h1>

            <form action="{{ route('store_manager.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="image" class="form-label">Product Image</label>
                        <input type="file" name="image" id="image"
                            class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="rice_type" class="form-label">Rice Type</label>
                        <input type="text" name="rice_type" id="rice_type"
                            class="form-control @error('rice_type') is-invalid @enderror" value="{{ old('rice_type') }}"
                            required>
                        @error('rice_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-12 mb-3">
                        <label for="unit" class="form-label">Unit</label>
                        <select name="unit" id="unit" class="form-select @error('unit') is-invalid @enderror"
                            required>
                            <option value="5" {{ old('unit') == '5' ? 'selected' : '' }}>5</option>
                            <option value="10" {{ old('unit') == '10' ? 'selected' : '' }}>10</option>
                            <option value="25" {{ old('unit') == '25' ? 'selected' : '' }}>25</option>
                            <option value="50" {{ old('unit') == '50' ? 'selected' : '' }}>50</option>
                        </select>
                        @error('unit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Unit Price -->
                    <div class="col-12 mb-3">
                        <label for="unit_price" class="form-label">Unit Price</label>
                        <input type="number" name="unit_price" id="unit_price"
                            class="form-control @error('unit_price') is-invalid @enderror" value="{{ old('unit_price') }}"
                            step="0.01" required>
                        @error('unit_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Selling Price -->
                    <div class="col-12 mb-3">
                        <label for="selling_price" class="form-label">Selling Price</label>
                        <input type="number" name="selling_price" id="selling_price"
                            class="form-control @error('selling_price') is-invalid @enderror"
                            value="{{ old('selling_price') }}" step="0.01" required>
                        @error('selling_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Target Level -->
                    <div class="col-12 mb-3">
                        <label for="target_level" class="form-label">Target Level</label>
                        <input type="number" name="target_level" id="target_level"
                            class="form-control @error('target_level') is-invalid @enderror"
                            value="{{ old('target_level') }}" required>
                        @error('target_level')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Reorder Level -->
                    <div class="col-12 mb-3">
                        <label for="reorder_level" class="form-label">Reorder Level</label>
                        <input type="number" name="reorder_level" id="reorder_level"
                            class="form-control @error('reorder_level') is-invalid @enderror"
                            value="{{ old('reorder_level') }}" required>
                        @error('reorder_level')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12 text-center mt-3">
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
