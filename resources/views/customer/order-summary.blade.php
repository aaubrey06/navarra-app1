@extends('layouts.customer_layout')

@section('title', 'Order Summary')

@section('contents')

    <section class="section">
        <div class="row">
            <div class="col-lg-12">


                @php
                    $cartItems = session()->get('cartItems', []);
                    $totalPrice = 0;
                    // $totalPrice = calculateTotalPrice($cartItems);
                    $totalQuantity = 0; // Initialize total quantity
                @endphp

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order Summary</h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Rice type</th>
                                    <th>Unit</th>
                                    <th>Selling Price</th>
                                    <th>Quantity</th>
                                    <th>Total Selling Price</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($cartItems as $item)
                                <tr>
                                    <td><!--Image of the Product--></td>
                                    <td>{{ $item['rice_type'] }}</td>
                                    <td>{{ $item['unit'] }}</td>
                                    <td>{{ $item['selling_price'] }}</td>
                                    <td>{{ $item['quantity'] }}</td>
                                    <td>{{ $item['total_selling_price'] }}</td>
                                </tr>

                                @php
                                    $totalPrice += $item['total_selling_price'];

                                    $totalQuantity += $item['quantity']; // Accumulate total quantity
                                @endphp

                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No products added yet</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                        <div class="card-body">
                            <h5 class="card-title">Delivery Address</h5>
                            <h5>Grace Poe</h5>
                            <h5>09123456789</h5>
                            <h5>Iloilo City, Iloilo</h5>
                            <h5>5800</h5>
                            <button class="btn btn-primary edit-btn">Edit</button>
                        </div>

                        {{-- <div class="card-body">
                            <h5 class="card-title">Delivery Option</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="deliveryOption" id="delivery" value="delivery" checked>
                                <label class="form-check-label" for="delivery">
                                    Delivery
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="deliveryOption" id="pickup" value="pickup">
                                <label class="form-check-label" for="pickup">
                                    Pick-up
                                </label>
                            </div>
                        </div> --}}

                        <div class="card-body">
                            <h5 class="card-title">Delivery Option</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="deliveryOption" id="delivery" value="delivery"
                                @if($totalQuantity < 20) disabled @endif>
                                <label class="form-check-label" for="delivery">
                                    Delivery
                                    @if($totalQuantity < 20)
                                        <span class="text-muted">(Delivery is available for orders with 20 or more sacks)</span>
                                    @endif
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="deliveryOption" id="pickup" value="pickup"
                                @if($totalQuantity < 20) checked @endif>
                                <label class="form-check-label" for="pickup">
                                    Pick-up
                                </label>
                            </div>
                        </div>

                        {{-- <form action="{{ route('cart.placeOrder') }}" method="POST">
                            @csrf
                            <div class="text-end">
                                <h5>Total: ${{ number_format($totalPrice, 2) }}</h5>
                                <a href="{{ route('cart') }}" class="btn btn-success mx-2">Edit Order</a>
                                <button type="submit" class="btn btn-success mx-2">Place Order</button>
                            </div>
                        </form> --}}

                        <form id="placeOrderForm" action="{{ route('cart.placeOrder') }}" method="POST">
                            @csrf
                            <div class="text-end">
                                <h5>Total: ${{ number_format($totalPrice, 2) }}</h5>
                                <a href="{{ route('cart') }}" class="btn btn-success mx-2">Edit Order</a>
                                <button type="button" id="placeOrderBtn" class="btn btn-success mx-2">Place Order</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('placeOrderBtn').addEventListener('click', function() {
            const confirmOrder = confirm('Payment for this order is available exclusively via Cash on Delivery (COD). By selecting "OK," you agree to proceed with this payment method. Do you wish to continue with your order?');

            if (confirmOrder) {
                document.getElementById('placeOrderForm').submit(); // Proceed with form submission
            } else {
                // Do nothing, stay on the page
            }
        });
    </script>
@endsection
