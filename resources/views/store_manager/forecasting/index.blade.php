@extends('layouts.store-manager_layout')

@section('contents')
    <h1>Forecasting</h1>

    <!-- Filter Dropdown -->
    <div>
        <label for="timeFrame">Select Time Frame: </label>
        <select id="timeFrame" name="timeFrame">
            <option value="weekly">Weekly</option>
            <option value="monthly">Monthly</option>
            <option value="yearly">Yearly</option>
        </select>
    </div>

    <!-- Moving Average Chart -->
    <div>
        <canvas id="movingAverageChart" width="400" height="200"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Initialize the moving averages data (from the server-side)
        const movingAverages = @json($result);
        const weeklyLabels = @json($weeklyLabels); // Labels for weekly view
        const monthlyLabels = @json($monthlyLabels); // Labels for monthly view
        const yearlyLabels = @json($yearlyLabels); // Labels for yearly view

        let labels = weeklyLabels;
        let data = movingAverages.weekly; // Default to weekly data

        const ctx = document.getElementById('movingAverageChart').getContext('2d');
        let chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Moving Average',
                    data: data,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false,
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Period'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Moving Average'
                        },
                        beginAtZero: true
                    }
                }
            }
        });

        document.getElementById('timeFrame').addEventListener('change', function() {
            const selectedTimeFrame = this.value;

            switch (selectedTimeFrame) {
                case 'weekly':
                    labels = weeklyLabels;
                    data = movingAverages.weekly;
                    break;
                case 'monthly':
                    labels = monthlyLabels;
                    data = movingAverages.monthly;
                    break;
                case 'yearly':
                    labels = yearlyLabels;
                    data = movingAverages.yearly;
                    break;
            }

            chart.data.labels = labels;
            chart.data.datasets[0].data = data;
            chart.update();
        });
    </script>
@endsection
