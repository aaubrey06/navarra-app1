@extends('layouts.store-manager_layout')

@section('contents')
    <div class="container mt-5">
        <h1 class="text-center">In-Store Order</h1>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4 shadow-sm">
                    <form action="{{ route('store_manager.orders.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="customerName" class="form-label">Customer Name</label>
                            <input type="text" class="form-control" id="customerName" name="customer_name" required>
                        </div>

                        <div class="mb-3">
                            <label for="product" class="form-label">Product</label>
                            <select class="form-select" id="product" name="product_id" required>
                                <option value="">Select a product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" data-unit="{{ $product->unit }}"
                                        data-rice-type="{{ $product->rice_type }}">
                                        {{ $product->rice_type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" min="1"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="unit" class="form-label">Unit</label>
                            <input type="text" class="form-control" id="unit" name="unit" required>
                        </div>

                        <div class="mb-3">
                            <label for="orderType" class="form-label">Order Type</label>
                            <select class="form-select" id="orderType" name="order_type" required>
                                <option value="pickup">Pickup</option>
                                <option value="delivery">Delivery</option>
                            </select>
                        </div>

                        <div id="delivery-info" class="mb-3 d-none">
                            <label for="address" class="form-label">Delivery Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="Enter delivery address" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('product').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const unit = selectedOption.getAttribute('data-unit');
            document.getElementById('unit').value = unit;
        });

        document.getElementById('quantity').addEventListener('input', function() {
            const quantity = parseInt(this.value);
            const deliveryOption = document.getElementById('deliveryOption');
            const deliveryInfo = document.getElementById('delivery-info');

            if (quantity >= 20) {
                deliveryOption.disabled = false;
            } else {
                deliveryOption.disabled = true;
                document.getElementById('orderType').value = 'pickup';
                deliveryInfo.classList.add('d-none');
            }
        });

        document.getElementById('orderType').addEventListener('change', function() {
            const deliveryInfo = document.getElementById('delivery-info');
            const quantity = parseInt(document.getElementById('quantity').value);

            if (this.value === 'delivery' && quantity >= 20) {
                deliveryInfo.classList.remove('d-none');
            } else {
                deliveryInfo.classList.add('d-none');
            }
        });
    </script>
@endsection
