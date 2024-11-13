@extends('layouts.store-manager_layout')

@section('contents')
    <div class="container">
        <h1>Sales Forecast Dashboard</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Display the forecasted sales data in a table -->
        <div class="mt-4">
            <h3>Forecasted Sales Data</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Forecasted Sales</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        // Sample data to test the table and chart
                        $forecastData = [
                            ['date' => '2024-11-01', 'forecasted_sales' => 1200],
                            ['date' => '2024-11-02', 'forecasted_sales' => 1300],
                            ['date' => '2024-11-03', 'forecasted_sales' => 1150],
                            ['date' => '2024-11-04', 'forecasted_sales' => 1250],
                            ['date' => '2024-11-05', 'forecasted_sales' => 1350],
                            ['date' => '2024-11-06', 'forecasted_sales' => 1400],
                        ];
                    @endphp

                    @foreach ($forecastData as $data)
                        <tr>
                            <td>{{ $data['date'] }}</td>
                            <td>{{ number_format($data['forecasted_sales'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Display the Sales Forecast Chart -->
        <div class="mt-4">
            <h3>Sales Forecast Chart</h3>
            <canvas id="forecastChart" width="400" height="200"></canvas>
        </div>

        <!-- Form to upload sales data (CSV) -->
        <form action="{{ route('forecast.sales.upload') }}" method="POST" enctype="multipart/form-data" class="mt-4">
            @csrf
            <div class="form-group">
                <label for="sales_data">Upload Sales Data (CSV):</label>
                <input type="file" name="sales_data" id="sales_data" required class="form-control">
            </div>
            <button type="submit" class="btn btn-primary mt-2">Upload Data</button>
        </form>

        <!-- Form to run the forecast -->
        <form action="{{ route('forecast.sales.run') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="btn btn-success">Run Forecast</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Simulating the data for testing
            const forecastData = {
                dates: ['2024-11-01', '2024-11-02', '2024-11-03', '2024-11-04', '2024-11-05', '2024-11-06'],
                forecasted_sales: [1200, 1300, 1150, 1250, 1350, 1400] // Sample data for the forecasted sales
            };

            const ctx = document.getElementById('forecastChart').getContext('2d');

            // Create the forecast chart
            const forecastChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: forecastData.dates,
                    datasets: [{
                        label: 'Forecasted Sales',
                        data: forecastData.forecasted_sales,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        fill: false
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Date'
                            }
                        },
                        y: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Sales'
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
