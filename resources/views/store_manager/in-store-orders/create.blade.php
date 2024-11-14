@extends('layouts.store-manager_layout')

@section('contents')
    <h1 class="text-center mb-4">Add New Order</h1>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('store_manager.in-store-orders.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="customer_name">Customer Name</label>
                        <input type="text" name="customer_name" id="customer_name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="product_id">Rice Type</label>
                        <select name="product_id" id="product_id" class="form-control" required>
                            <option value="">Select Rice Type</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->product_id }}" data-price="{{ $product->unit_price }}">
                                    {{ $product->rice_type }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <select name="unit" id="unit" class="form-control" required>
                            <option value="">Select Unit</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" name="price" id="price" class="form-control" required readonly>
                    </div>

                    <div class="form-group">
                        <label for="method">Order Method</label>
                        <select name="method" id="method" class="form-control" required>
                            <option value="pickup">Pickup</option>
                            <option value="delivery">Delivery</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="location">Location (only for delivery)</label>
                        <input type="text" name="location" id="location" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="order_date">Order Date</label>
                        <input type="date" name="order_date" id="order_date" class="form-control" required>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-success">Add Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productSelect = document.getElementById('product_id');
            const quantityInput = document.getElementById('quantity');
            const priceInput = document.getElementById('price');

            function updatePrice() {
                // Get the selected product and its unit price (from data-price attribute)
                const selectedProduct = productSelect.options[productSelect.selectedIndex];
                const pricePerUnit = parseFloat(selectedProduct.getAttribute('data-price')) || 0;

                // Get the quantity entered by the user
                const quantity = parseFloat(quantityInput.value) || 0;

                // Calculate the total price
                const totalPrice = pricePerUnit * quantity;

                // Update the price field with the calculated total price
                priceInput.value = totalPrice.toFixed(2);
            }

            // Event listeners for changes on product selection and quantity input
            productSelect.addEventListener('change', updatePrice);
            quantityInput.addEventListener('input', updatePrice);
        });
    </script>
@endsection
