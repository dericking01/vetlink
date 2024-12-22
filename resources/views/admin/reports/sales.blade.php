@extends('layouts.admin.base')

@section('content')
<div class="container">
    <h1>Sales Report</h1>

    <!-- Export Form -->
    <div class="card shadow-sm p-3 mb-4 rounded">
        <div class="card-body">
            <form action="{{ route('export.sales-report') }}" method="GET">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label" for="timepicker2">Select Date Range</label>
                        <input class="form-control datetimepicker" id="timepicker2" name="date_range" type="text" placeholder="d/m/y to d/m/y" data-options='{"mode":"range","dateFormat":"d/m/y","disableMobile":true}' />
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-file-export"></i> Export Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Wrap the chart in a div with specific dimensions -->
    <div style="width: 1200px;">
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

<!-- Include your JS and CSS for datetime picker -->
@section('scripts')
<script>
    // Initialize the datetime picker for the input field
    flatpickr("#timepicker2", {
        mode: "range",
        dateFormat: "d/m/y",
        disableMobile: true,
    });
</script>
@endsection

@endsection
