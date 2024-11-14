@extends('layouts.owner_layout')

@section('title', 'Dashboard')

@section('contents')
    <section class="section dashboard">
        <div class="row mb-4">
            <!-- Metric Cards Row -->
            <div class="row mt-4 mb-4">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card info-card shadow-lg border-0 rounded-4 p-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="icon-box bg-primary text-white rounded-circle p-4 me-3 shadow-lg">
                                    <i class="bi bi-currency-dollar fs-3"></i> <!-- Adjusted icon size -->
                                </div>
                                <div class="text-center">
                                    <h5 class="mb-1 text-primary fw-bold">₱{{ number_format($totalSales, 2) }}</h5>
                                    <small class="text-muted">Total Sales</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card info-card shadow-lg border-0 rounded-4 p-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="icon-box bg-info text-white rounded-circle p-4 me-3 shadow-lg">
                                    <i class="bi bi-cart-check fs-3"></i> <!-- Adjusted icon size -->
                                </div>
                                <div class="text-center">
                                    <h5 class="mb-1 text-info fw-bold">{{ $totalOrders }}</h5>
                                    <small class="text-muted">Total Transactions</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card info-card shadow-lg border-0 rounded-4 p-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="icon-box bg-success text-white rounded-circle p-4 me-3 shadow-lg">
                                    <i class="bi bi-shop fs-3"></i> <!-- Adjusted icon size -->
                                </div>
                                <div class="text-center">
                                    <h5 class="mb-1 text-success fw-bold">{{ $orderstoreOrdersCount }}</h5>
                                    <small class="text-muted">Store Orders</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card info-card shadow-lg border-0 rounded-4 p-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="icon-box bg-warning text-white rounded-circle p-4 me-3 shadow-lg">
                                    <i class="bi bi-basket-fill fs-3"></i> <!-- Adjusted icon size -->
                                </div>
                                <div class="text-center">
                                    <h5 class="mb-1 text-warning fw-bold">{{ $salesTableOrdersCount }}</h5>
                                    <small class="text-muted">Retail Sales</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Sales and Orders Table -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">Recent Sales</h5>
                                <a href="#" class="btn btn-outline-primary btn-sm">View All</a>
                            </div>
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#2457</td>
                                        <td>Product A</td>
                                        <td>Category A</td>
                                        <td>₱120</td>
                                        <td>2024-11-10</td>
                                    </tr>
                                    <tr>
                                        <td>#2147</td>
                                        <td>Product B</td>
                                        <td>Category B</td>
                                        <td>₱85</td>
                                        <td>2024-11-08</td>
                                    </tr>
                                    <tr>
                                        <td>#2049</td>
                                        <td>Product C</td>
                                        <td>Category C</td>
                                        <td>₱60</td>
                                        <td>2024-11-07</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Forecasting Graphs -->
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card shadow-lg border-0">
                        <div class="card-body">
                            <h5 class="card-title">Sales Forecasting <span class="text-muted small">| Projected Sales
                                    Trends</span></h5>
                            <div id="forecastChart"></div>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#forecastChart"), {
                                        series: [{
                                            name: 'Forecasted Sales',
                                            data: [45, 55, 60, 70, 80, 90, 100, 110, 115, 120, 130, 140]
                                        }],
                                        chart: {
                                            height: 350,
                                            type: 'line',
                                            toolbar: {
                                                show: false
                                            }
                                        },
                                        colors: ['#007bff'],
                                        dataLabels: {
                                            enabled: false
                                        },
                                        stroke: {
                                            curve: 'smooth',
                                            width: 2
                                        },
                                        xaxis: {
                                            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct",
                                                "Nov", "Dec"
                                            ]
                                        },
                                        tooltip: {
                                            x: {
                                                format: 'MM'
                                            }
                                        }
                                    }).render();
                                });
                            </script>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card shadow-lg border-0">
                        <div class="card-body">
                            <h5 class="card-title">Demand Forecasting <span class="text-muted small">| Projected Demand
                                    Trends</span></h5>
                            <div id="demandForecastChart"></div>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#demandForecastChart"), {
                                        series: [{
                                            name: 'Forecasted Demand',
                                            data: [50, 60, 70, 80, 85, 95, 105, 115, 120, 130, 140, 150]
                                        }],
                                        chart: {
                                            height: 350,
                                            type: 'line',
                                            toolbar: {
                                                show: false
                                            }
                                        },
                                        colors: ['#28a745'],
                                        dataLabels: {
                                            enabled: false
                                        },
                                        stroke: {
                                            curve: 'smooth',
                                            width: 2
                                        },
                                        xaxis: {
                                            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct",
                                                "Nov", "Dec"
                                            ]
                                        },
                                        tooltip: {
                                            x: {
                                                format: 'MM'
                                            }
                                        }
                                    }).render();
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
