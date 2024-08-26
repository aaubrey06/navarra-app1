@extends('layouts.customer_layout')

@section('title', 'My Cart')

@section('contents')

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                @php
                    $cartItems = session()->get('cartItems', []);
                @endphp
                
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">My Cart</h5>

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($cartItems as $item)
                                <tr>
                                    <td><!--Image of the Product--></td>
                                    <td>{{ $item['rice_type'] }}</td>
                                    <td>{{ $item['unit'] }}</td>
                                    <td>{{ $item['selling_price'] }}</td>
                                    <td>
                                        {{-- <input type="number" name="quantity" value="{{ $item['quantity'] }}" class="form-control" id="quantity" /> --}}
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" class="form-control quantity" data-product-id="{{ $item['product_id'] }}" min="1" />
                                    </td>
                                    {{-- <td>{{ $item['total_selling_price'] }}</td> --}}
                                    <td class="total_selling_price">{{ $item['total_selling_price'] }}</td>

                                    <td>
                                        <form action="{{ route('cart.remove', $item['product_id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No products added yet</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                        <div class="text-end">
                            <!-- Wrap the checkout button inside a form -->
                            <form action="{{ route('cart.summary') }}" method="GET" id="checkoutForm">
                                <button type="submit" class="btn btn-success mx-2" id="checkoutButton">Check Out</button>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.querySelectorAll('.quantity').forEach(input => {
            input.addEventListener('change', function() {
                const productId = this.dataset.productId;
                const quantity = this.value;

                fetch('{{ route('cart.update') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ product_id: productId, quantity: quantity })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const row = this.closest('tr');
                        // row.querySelector('.total_selling_price').textContent = data.total_selling_price;
                        const totalSellingPriceElement = row.querySelector('.total_selling_price');
                        totalSellingPriceElement.textContent = data.total_selling_price;
                    }
                });
            });
        });

        document.querySelector('#checkoutButton').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default form submission

            const result = confirm('Delivery is available for orders with 20 or more sacks. For orders with a smaller number of sacks, pick-up is only available. Are you sure to continue?');

            if (result) {
                // If the user clicks "OK", submit the form programmatically
                document.querySelector('#checkoutForm').submit();
            } else {
                // If the user clicks "Cancel", do nothing
                return false;
            }
        });
    </script>

@endsection
