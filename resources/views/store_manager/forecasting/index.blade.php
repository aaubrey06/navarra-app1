@extends('layouts.store-manager_layout')

@section('contents')
    <h1>Moving Average Forecast for Rice Sales</h1>

    <form id="groupingForm" method="GET" action="{{ route('store_manager.forecasting.showForecast') }}">
        <label for="groupBy">Group data by:</label>
        <select id="groupBy" name="group_by" onchange="document.getElementById('groupingForm').submit()">
            <option value="none" {{ request('group_by') == 'none' ? 'selected' : '' }}>All</option>
            <option value="weekly" {{ request('group_by') == 'weekly' ? 'selected' : '' }}>Weekly</option>
            <option value="monthly" {{ request('group_by') == 'monthly' ? 'selected' : '' }}>Monthly</option>
            <option value="yearly" {{ request('group_by') == 'yearly' ? 'selected' : '' }}>Yearly</option>
        </select>
    </form>

    <div style="max-width: 1000px; margin: 20px auto;">
        <canvas id="salesChart" style="width: 100%; height: 400px;"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Prepare data for the chart
        const salesData = @json($data); // Pass data from Laravel to JavaScript
        const salesDates = salesData.map(row => row.sales_date);
        const quantitiesSold = salesData.map(row => row.quantity_sold);
        const movingAverages = @json($movingAverages); // Pass moving averages data
        const forecasts = movingAverages; // Assuming forecast is similar to the moving average

        // Format the date to a more readable form (e.g., MM-DD)
        const formattedSalesDates = salesDates.map(date => new Date(date).toLocaleDateString('en-US', {
            month: 'short',
            day: 'numeric',
        }));

        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: formattedSalesDates,
                datasets: [{
                        label: 'Quantity Sold',
                        data: quantitiesSold,
                        borderColor: 'rgba(75, 192, 192, 1)', // Light teal
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: true,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        borderWidth: 2,
                    },
                    {
                        label: 'Moving Average',
                        data: movingAverages,
                        borderColor: 'rgba(153, 102, 255, 1)', // Purple
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        fill: false,
                        borderWidth: 2,
                        borderDash: [5, 5], // Dashed line for moving average
                        pointRadius: 4,
                        pointHoverRadius: 6,
                    },
                    {
                        label: 'Forecast',
                        data: forecasts,
                        borderColor: 'rgba(255, 159, 64, 1)', // Orange
                        backgroundColor: 'rgba(255, 159, 64, 0.2)',
                        fill: false,
                        borderWidth: 2,
                        borderDash: [10, 5], // Forecast line is dashed
                        pointRadius: 4,
                        pointHoverRadius: 6,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Sales Date',
                        },
                        ticks: {
                            maxRotation: 45, // Rotate labels to fit
                            minRotation: 45,
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Quantity Sold',
                        },
                        beginAtZero: true, // Ensure y-axis starts from zero
                        ticks: {
                            stepSize: 5, // Set appropriate step size for y-axis values
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                family: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
                                weight: 'bold',
                                size: 14,
                            },
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                const label = tooltipItem.dataset.label || '';
                                const value = tooltipItem.raw.toLocaleString(); // Format number with commas
                                return label + ': ' + value;
                            }
                        }
                    },
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        font: {
                            weight: 'bold',
                            size: 12,
                        },
                        formatter: function(value) {
                            return value.toLocaleString(); // Show value with commas
                        }
                    }
                }
            }
        });
    </script>


    <table class="table table-striped">
        <thead>
            <tr>
                <th>Period</th>
                <th>Sales Date</th>
                <th>Quantity Sold</th>
                <th>Moving Average</th>
                <th>Forecast</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $row)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $row['sales_date'] }}</td>
                    <td>{{ $row['quantity_sold'] }}</td>
                    <td>
                        {{ isset($movingAverages[$index]) ? $movingAverages[$index] : '-' }}
                    </td>
                    <td>
                        @if ($index < count($data) - 1)
                            {{ isset($movingAverages[$index]) ? $movingAverages[$index] : '-' }}
                        @else
                            {{ isset($movingAverages) && count($movingAverages) > 0 ? end($movingAverages) : '-' }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Chart.js -->
@endsection
