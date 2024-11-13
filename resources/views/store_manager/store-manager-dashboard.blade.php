@extends('layouts.store-manager_layout')

@section('title', 'Dashboard')

@section('contents')
    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                    <!-- Sales Table -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Sales Table <span>| Filter by time period</span></h5>
                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Price</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row"><a href="#">#2457</a></th>
                                            <td>Product A</td>
                                            <td>Category A</td>
                                            <td>$120</td>

                                        </tr>
                                        <tr>
                                            <th scope="row"><a href="#">#2147</a></th>
                                            <td>Product B</td>
                                            <td>Category B</td>
                                            <td>$85</td>

                                        </tr>
                                        <tr>
                                            <th scope="row"><a href="#">#2049</a></th>
                                            <td>Product C</td>
                                            <td>Category C</td>
                                            <td>$60</td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- End Sales Table -->

                    <!-- Forecasting Graph -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Sales Forecasting <span>| Projected Sales Trends</span></h5>
                                <!-- Forecasting Chart -->
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
                                                },
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
                                                },
                                            }
                                        }).render();
                                    });
                                </script>
                                <!-- End Forecasting Chart -->
                            </div>
                        </div>
                    </div><!-- End Forecasting Graph -->

                    <!-- Demand Forecasting Graph -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Demand Forecasting <span>| Projected Demand Trends</span></h5>
                                <!-- Demand Forecasting Chart -->
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
                                                },
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
                                                },
                                            }
                                        }).render();
                                    });
                                </script>
                                <!-- End Demand Forecasting Chart -->
                            </div>
                        </div>
                    </div><!-- End Demand Forecasting Graph -->

                </div>
            </div><!-- End Left side columns -->

        </div>
    </section>
@endsection
