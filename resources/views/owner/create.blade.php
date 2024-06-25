@extends('layouts.owner_layout')

@section('contents')
    <section class="section">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title mb-3 text-center">Add Product</h2>

                        <form action="{{ route('owner.products.store') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label for="rice_type" class="col-sm-2 col-form-label">Rice Type</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="rice_type" name="rice_type" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="unit" class="col-sm-2 col-form-label">Unit</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="unit" name="unit" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="unit_price" class="col-sm-2 col-form-label">Unit Price</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="unit_price" name="unit_price" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="selling_price" class="col-sm-2 col-form-label">Selling Price</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="selling_price" name="selling_price"
                                        required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="target_level" class="col-sm-2 col-form-label">Target Level</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="target_level" name="target_level"
                                        required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="reorder_level" class="col-sm-2 col-form-label">Re-order Level</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="reorder_level" name="reorder_level"
                                        required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-rounded">Add Product</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
