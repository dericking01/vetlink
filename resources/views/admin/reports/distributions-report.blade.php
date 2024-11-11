@extends('layouts.admin.base')

@section('content')
<div class="container my-4">
    <h3 class="text-center text-primary mb-4">Export Product Distributions</h3>

    <!-- Form to select date range and export data -->
    <div class="card shadow-sm p-3 mb-4 rounded">
        <div class="card-body">
            <form action="{{ route('export.product-distributions') }}" method="GET">
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
        <h4 class="text-dark text-center mb-3">Product Distributions:</h4>
        <div class="table-responsive">
            {{-- <table class="table table-bordered table-striped table-hover fs--1 mb-0"> --}}
            <table class="table data-table table-bordered table-striped fs--1 mb-0">

                <thead class="thead-dark">
                    <tr>
                        <th>Date</th>
                        <th>To Branch</th>
                        <th>Product Name</th>
                        <th>Quantity Distributed</th>
                        <th>Units</th>
                        <th>Price</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($distributions as $distribution)
                        <tr>
                            <td class="date">{{ date_format(date_create($distribution->created_at), 'd M, Y') }}</td>
                            <td>{{ $distribution->branch->branch_name }}</td>
                            <td>{{ $distribution->adminProduct->name }}</td>
                            <td>{{ $distribution->quantity }}</td>
                            <td>{{ $distribution->adminProduct->units }}</td>
                            <td>{{ number_format($distribution->price, 2) }}</td>
                            <td>
                                @if ($distribution->adminProduct->description)
                                    {{ $distribution->adminProduct->description }}
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
