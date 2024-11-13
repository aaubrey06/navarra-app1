@extends('layouts.store-manager_layout')


@section('contents')
    <div class="container">
        <h1>Sales Forecast Dashboard</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        <form action="{{ route('forecast.sales.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="sales_data">Upload Sales Data (CSV):</label>
                <input type="file" name="sales_data" id="sales_data" required class="form-control">
            </div>
            <button type="submit" class="btn btn-primary mt-2">Upload Data</button>
        </form>


        <form action="{{ route('forecast.sales.run') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="btn btn-success">Run Forecast</button>
        </form>


        <div class="mt-4">
            <h3>Sales Forecast</h3>
            <canvas id="forecastChart" width="400" height="200"></canvas>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch("{{ route('forecast.sales.data') }}")
                .then(response => response.json())
                .then(data => {
                    const ctx = document.getElementById('forecastChart').getContext('2d');
                    const forecastChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: data.dates,
                            datasets: [{
                                label: 'Forecasted Sales',
                                data: data.forecasted_sales,
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
                })
                .catch(error => console.error('Error fetching forecast data:', error));
        });
    </script>
@endsection
