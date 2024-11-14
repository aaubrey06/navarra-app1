@extends('layouts.store-manager_layout')

@section('contents')
    <h1 class="text-center mb-4">Edit Order</h1>

    <!-- Center the form using a Bootstrap container and flexbox -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('store_manager.in-store-orders.update', $order->order_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Customer Name Field -->
                    <div class="form-group">
                        <label for="customer_name">Customer Name</label>
                        <input type="text" name="customer_name" id="customer_name" class="form-control"
                            value="{{ old('customer_name', $order->customer_name) }}" required>
                    </div>

                    <!-- Phone Number Field -->
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control"
                            value="{{ old('phone_number', $order->phone_number) }}" required>
                    </div>

                    <!-- Product (Rice Type) Dropdown -->
                    <div class="form-group">
                        <label for="product_id">Rice Type</label>
                        <select name="product_id" id="product_id" class="form-control" required>
                            <option value="">Select Rice Type</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->product_id }}" data-price="{{ $product->unit_price }}"
                                    {{ $order->product_id == $product->product_id ? 'selected' : '' }}>
                                    {{ $product->rice_type }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Quantity Field -->
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control"
                            value="{{ old('quantity', $order->quantity) }}" required>
                    </div>

                    <!-- Unit (kg or sack) Dropdown -->
                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <select name="unit" id="unit" class="form-control" required>
                            <option value="5" {{ $order->unit == '5' ? 'selected' : '' }}>5</option>
                            <option value="10" {{ $order->unit == '10' ? 'selected' : '' }}>10</option>
                            <option value="25" {{ $order->unit == '25' ? 'selected' : '' }}>25</option>
                            <option value="50" {{ $order->unit == '50' ? 'selected' : '' }}>50</option>
                        </select>
                    </div>

                    <!-- Price Field (Read-Only) -->
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" name="price" id="price" class="form-control"
                            value="{{ old('price', $order->price) }}" required readonly>
                    </div>

                    <!-- Order Method Dropdown -->
                    <div class="form-group">
                        <label for="method">Order Method</label>
                        <select name="method" id="method" class="form-control" required>
                            <option value="pickup" {{ $order->method == 'pickup' ? 'selected' : '' }}>Pickup</option>
                            <option value="delivery" {{ $order->method == 'delivery' ? 'selected' : '' }}>Delivery</option>
                        </select>
                    </div>

                    <!-- Location Field (for delivery only) -->
                    <div class="form-group">
                        <label for="location">Location (only for delivery)</label>
                        <input type="text" name="location" id="location" class="form-control"
                            value="{{ old('location', $order->location) }}">
                    </div>

                    <!-- Order Date Field -->
                    <div class="form-group">
                        <label for="order_date">Order Date</label>
                        <input type="date" name="order_date" id="order_date" class="form-control"
                            value="{{ old('order_date', $order->order_date) }}" required>
                    </div>

                    <!-- Buttons -->
                    <div class="form-group text-center">
                        <!-- Update Order Button -->
                        <button type="submit" class="btn btn-success btn-lg mr-2">Update Order</button>
                        <!-- Cancel Button -->
                        <a href="{{ route('store_manager.in-store-orders.index') }}"
                            class="btn btn-secondary btn-lg">Cancel</a>
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

            // Function to update the price
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

            // Initialize the price field when the page loads, based on initial selection
            updatePrice();
        });
    </script>
@endsection
