@extends('layouts.store-manager_layout')

@section('contents')
    <div class="container mt-5">
        <h5>Create Stock Request</h5>

        <!-- Stock Request Form -->
        <form action="{{ route('store_manager.purchase_stock.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="supplier_name">Supplier Name</label>
                <input type="text" name="supplier_name" id="supplier_name" class="form-control" required>
                @error('supplier_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="product_id">Product Name</label>
                <select name="product_id" id="product_id" class="form-control" required>
                    <option value="">Select a Product</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                            {{ $product->rice_type }}
                        </option>
                    @endforeach
                </select>
                @error('product_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="quantity">Quantity Requested</label>
                <input type="number" name="quantity" id="quantity" class="form-control" required min="1">
                @error('quantity')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="total_amount">Total Amount</label>
                <input type="text" name="total_amount" id="total_amount" class="form-control" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Submit Request</button>
        </form>
    </div>

    <!-- JavaScript to update total amount -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productSelect = document.getElementById('product_id');
            const quantityInput = document.getElementById('quantity');
            const totalAmountInput = document.getElementById('total_amount');

            // Function to update the total amount based on the selected product and quantity
            function updateTotalAmount() {
                const selectedOption = productSelect.options[productSelect.selectedIndex];
                const productPrice = parseFloat(selectedOption.getAttribute('data-price')) || 0;
                const quantity = parseFloat(quantityInput.value) || 0;

                // Calculate total amount if valid inputs exist
                if (!isNaN(productPrice) && !isNaN(quantity) && productPrice > 0 && quantity > 0) {
                    const totalAmount = (productPrice * quantity).toFixed(2);
                    totalAmountInput.value = `₱${totalAmount}`;
                } else {
                    totalAmountInput.value = '₱0.00';
                }
            }

            // Event listeners to trigger the total amount update
            productSelect.addEventListener('change', updateTotalAmount);
            quantityInput.addEventListener('input', updateTotalAmount);
        });
    </script>
@endsection
