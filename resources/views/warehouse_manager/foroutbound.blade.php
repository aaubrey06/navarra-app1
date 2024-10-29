@extends('layouts.warehouse-manager_layout')

@section('contents')
    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="    -body">
                        <h5 class="card-title">For Outbound</h5>
                        <h3 class="card-title">Scan Result</h3>
                        <b><a>Rice Type:</b> {{ $data['products'][0]->rice_type }}<br></a>
                        {{-- <b><a>Product Code:</b> {{ $data['warehouse_stock'][0]->product_code }}<br></a> --}}
                        <b><a>Batch Code:</b> {{ $data['warehouse_stock'][0]->batch_code }}<br></a>
                        <?php
                                    echo $data['products'];
                                    echo $data['stock_requests']
                                ?>
                        <form action="{{ url('warehouse_manager/sendoutbound') }}" method="POST">
                            @csrf

                            <div class="row mb-3">
                                <label for="outbound_quantity" class="col-sm-10 col-form-label"><b>Quantity to
                                        Outbound</b></label>
                                <div class="col-sm-5">
                                    {{-- <input type="number" class="form-control" id="outbound_quantity"
                                        name="outbound_quantity" required>
                                    <input type="text" class="form-control" id="previous_value" name="previous_value"
                                        style="display: none" value=" {{ $data['warehouse_stock'][0]->quantity }}" required>
                                    <input type="text" class="form-control" id="warehouse_stocks_id"
                                        name="warehouse_stocks_id" style="display: none"
                                        value=" {{ $data['warehouse_stock'][0]->warehouse_stocks_id }}" required> --}}
                                        

                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-5">
                                    <a class="btn btn-primary" href="{{ route('warehouse') }}">Cancel</a>
                                </div>
                                <div class="col-sm-5">
                                    <button type="submit" class="btn btn-primary">Outbound</button>
                                </div>
                            </div>

                        </form>
                    @endsection
