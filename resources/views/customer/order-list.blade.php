@extends('layouts.customer_layout')

@section('title', 'Products')

@section('contents')

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order List</h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Tracking No.</th>
                                    <th>Delivery Date</th>
                                    <th>Payment Status</th>
                                    <th>Order Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dynamic product rows will go here -->
                                <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <a href="" class="btn btn-success mx-2" >Cancel</a>
                                        <a href="" class="btn btn-success mx-2">View</a>
                                        <a href="" class="btn btn-success mx-2">Confirm Delivery</a>
                                    </td>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
