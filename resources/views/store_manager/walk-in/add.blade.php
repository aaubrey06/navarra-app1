@extends('layouts.store-manager_layout')

@section('contents')
    <div class="container mt-5">
        <h4 class="text-center mb-4">In-Store</h4>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4 shadow-sm">
                    <form action="{{ route('store_manager.walk-in.store') }}" method="POST">
                        @csrf


                        <div class="mb-3">
                            <label for="product_id" class="form-label">Product Name</label>
                            <select name="product_id" id="product_id" class="form-select" required>
                                <option value="">Select Product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->product_id }}" data-price="{{ $product->selling_price }}">
                                        {{ $product->rice_type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="quantity_sold" class="form-label">Quantity Sold</label>
                            <input type="number" class="form-control" id="quantity_sold" name="quantity_sold"
                                min="1" required>
                        </div>


                        <div class="mb-3">
                            <label for="total_price" class="form-label">Total Price</label>
                            <input type="number" class="form-control" id="total_price" name="total_price" step="0.01"
                                readonly>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productSelect = document.getElementById('product_id');
            const quantityInput = document.getElementById('quantity_sold');
            const totalPriceInput = document.getElementById('total_price');

            function calculateTotalPrice() {
                const selectedProduct = productSelect.options[productSelect.selectedIndex];
                const price = parseFloat(selectedProduct.getAttribute('data-price')) || 0;
                const quantity = parseInt(quantityInput.value) || 0;
                const totalPrice = price * quantity;

                totalPriceInput.value = totalPrice.toFixed(2); // Update total price
            }

            productSelect.addEventListener('change', calculateTotalPrice);
            quantityInput.addEventListener('input', calculateTotalPrice);
        });
    </script>
@endsection
