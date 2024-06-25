@extends('layouts.owner_layout')

{{-- @section('title', 'Products') --}}

@section('contents')
    <div class="d-flex flex-column">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <b>
                <h2 class="mb-0">List of Products</h2>
            </b>
            <a href="{{ route('owner.create') }}" class="btn btn-primary btn-rounded">Add Product</a>
        </div>
    </div>
    <div></div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Table with stripped rows -->
                        <table class="table datatable table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Rice type</th>
                                    <th>Unit</th>
                                    <th>Unit Price</th>
                                    <th>Selling Price</th>
                                    <th>Target level</th>
                                    <th>Re-order level</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->rice_type }}</td>
                                        <td>{{ $product->unit }}</td>
                                        <td>{{ $product->unit_price }}</td>
                                        <td>{{ $product->selling_price }}</td>
                                        <td>{{ $product->target_level }}</td>
                                        <td>{{ $product->reorder_level }}</td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-primary">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>

                                            <form action="" method="post" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i> Delete
                                                </button>
                                            </form>

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
