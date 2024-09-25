@extends('layouts.admin.base')

@section('content')
<div class="container">
    <h1>Sales Report</h1>

    <!-- Wrap the chart in a div with specific dimensions -->
    <div style="width: 1200px ;">
        <canvas id="salesChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'bar', // or 'bar', 'pie', etc.
            data: {
                labels: {!! json_encode($dates) !!},
                datasets: [{
                    label: 'Total Sales',
                    data: {!! json_encode($totalSales) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: true,
                    borderRadius: 2,
                    grouped: false
                }]
            },
            options: {
                responsive: true,
                // Let Chart.js manage aspect ratio properly by default
                maintainAspectRatio: true,
                indexAxis: 'x',
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</div>
@endsection
