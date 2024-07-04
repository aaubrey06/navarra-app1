@extends('layouts.customer_layout')

@section('title', 'Products')

@section('contents')

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">List of Products</h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Rice type</th>
                                    <th>Unit</th>
                                    <th>Selling Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td><!--Image of the Product--></td>
                                        <td>{{ $product->rice_type }}</td>
                                        <td>{{ $product->unit }}</td>
                                        <td>{{ $product->selling_price }}</td>
                                        <td>
                                            <a href="{{ route('cart', $product->product_id) }}" class="btn btn-success mx-2" >Add to Cart</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
