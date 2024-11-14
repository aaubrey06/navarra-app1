@extends('layouts.owner_layout')

@section('contents')
    <h1 class="text-center mb-5 text-primary">Sales Overview</h1>

    <div class="card shadow-lg border-0 mb-4">
        <div class="card-body">
            <h3 class="card-title text-center text-primary">Overall Sales</h3>

            <div class="row">
                <!-- Total Sales Table -->
                <div class="col-md-6 mb-4">
                    <h5 class="text-center text-secondary">Total Sales</h5>
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th class="text-center bg-light">Total Sales</th>
                            <td class="text-center font-weight-bold text-success">₱{{ number_format($totalSales, 2) }}</td>
                        </tr>
                    </table>
                </div>

                <!-- Total Transactions Table -->
                <div class="col-md-6 mb-4">
                    <h5 class="text-center text-secondary">Total Transactions</h5>
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th class="text-center bg-light">Total Transactions</th>
                            <td class="text-center font-weight-bold text-info">{{ $totalOrders }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row">
                <!-- Store Orders Table -->
                <div class="col-md-6 mb-4">
                    <h5 class="text-center text-secondary">Store Orders</h5>
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th class="text-center bg-light">Store Orders</th>
                            <td class="text-center font-weight-bold text-primary">{{ $orderstoreOrdersCount }}</td>
                        </tr>
                    </table>
                </div>

                <!-- Retail Sales Table -->
                <div class="col-md-6 mb-4">
                    <h5 class="text-center text-secondary">Retail Sales</h5>
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th class="text-center bg-light">Retail Sales</th>
                            <td class="text-center font-weight-bold text-warning">{{ $salesTableOrdersCount }}</td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
