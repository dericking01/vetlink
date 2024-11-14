@extends('layouts.admin.base')

@section('content')
<div class="container my-4">
    <h3 class="text-center text-primary mb-4">Export Stock Report</h3>

    <!-- Form to select date range and export data -->
    <div class="card shadow-sm p-3 mb-4 rounded">
        <div class="card-body">
            <form action="{{ route('export.stock-report') }}" method="GET">
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

    <!-- Product Distributions Table -->
    <div class="card shadow-sm p-3 mb-4 bg-light rounded">
        <h4 class="text-dark text-center mb-3">Stock Report Data:</h4>
        <div class="table-responsive">
            {{-- <table class="table table-bordered table-striped table-hover fs--1 mb-0"> --}}
            <table class="table data-table table-bordered table-striped fs--1 mb-0">

                <thead class="thead-dark">
                    <tr>
                        <th>Date</th>
                        <th>Branch Name</th>
                        <th>Product Name</th>
                        <th>Total Quantity</th>
                        <th>Available Quantity</th>
                        <th>Unit Price</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stocks as $stock)
                        <tr>
                            <td class="date">{{ date_format(date_create($stock['updated_on']), 'd M, Y') }}</td>
                            <td>{{ $stock['branch_name'] }}</td>
                            <td>{{ $stock['product_name'] }}</td>
                            <td>{{ $stock['total_quantity'] }}</td>
                            <td>{{ $stock['available_quantity'] }}</td>
                            <td>{{ $stock['price'] ? number_format((float)$stock['price'], 2) : '0.00' }}</td>

                            <td>
                                @if (!empty($stock['description']))
                                    {{ $stock['description'] }}
                                @else
                                    <span class="badge badge-subtle-danger">NONE</span>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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
