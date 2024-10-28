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
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>




    @endsection
