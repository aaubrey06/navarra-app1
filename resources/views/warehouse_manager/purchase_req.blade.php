@extends('layouts.warehouse-manager_layout')

@section('title', 'Purchase Request')


@section('contents')

    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <div class="d-flex flex-column">



        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Warehouse Stocks</h5>


                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Request Number</th>
                                        <th>Date</th>
                                        <th>Requested By</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Scan QR Code</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requests as $request)
                                        <tr>
                                            <td>
                                                {{ $request->request_id }}
                                            </td>
                                            <td>
                                                {{ $request->created_at->toDateString() }}
                                            </td>
                                            <td>
                                                <?php
                                                // $store = json_decode(json_encode($store), true);
                                                foreach ($stores as $key => $store) {
                                                    if ($store->store_id == $request->store_id) {
                                                        echo $store->store_name;
                                                    }
                                                }
                                                
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                // $store = json_decode(json_encode($store), true);
                                                foreach ($products as $key => $product) {
                                                    if ($product->product_id == $request->product_id) {
                                                        echo $product->rice_type;
                                                    }
                                                }
                                                ?>
                                            </td>

                                            <td>

                                                {{ $request->quantity_requested }}
                                            </td>
                                            <td>

                                                <a class="button button-primary"
                                                    href="{{ route('qrScan', $request->request_id) }}"> Scan QR</a>
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
