@extends('layouts.admin.base')

@section('content')
<div class="container mt-4">
    <!-- Custom Styles -->
    <style>
        .badge-custom-success {
            background-color: #28a745; /* Bootstrap success color */
            color: white;
        }
        .badge-custom-danger {
            background-color: #dc3545; /* Bootstrap danger color */
            color: white;
        }
    </style>

    <!-- Branch Details -->
    <div class="card shadow-sm p-3 mb-4 bg-white rounded">
        <h2 class="text-center text-primary">{{ $branch->branch_name }}</h2>
        <p class="text-muted text-center"><strong>Location:</strong> {{ $branch->location }}</p>
        <p class="text-muted text-center"><strong>Status:</strong>
            <span class="badge {{ $branch->status === 'active' ? 'badge-custom-success' : 'badge-custom-danger' }}">
                {{ $branch->status === 'active' ? 'ACTIVE' : 'INACTIVE' }}
            </span>
        </p>
    </div>

    <!-- View Stock Button -->
    <div class="text-center mb-3">
        <button onclick="history.back()" class="btn btn-danger">
            Back
        </button>
    </div>

    <!-- Product Distribution Table -->
    <div class="card shadow-sm p-3 mb-4 bg-light rounded">
        <div class="col text-end">
            <a class="font-sans-serif" href="{{ route('export.branchstock', ['branchId' => $branch->id]) }}">
                <button class="btn btn-falcon-default btn-sm" type="button"><svg class="svg-inline--fa fa-external-link-alt fa-w-16" data-fa-transform="shrink-3 down-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="external-link-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="transform-origin: 0.5em 0.625em;"><g transform="translate(256 256)"><g transform="translate(0, 64)  scale(0.8125, 0.8125)  rotate(0 0 0)"><path fill="currentColor" d="M432,320H400a16,16,0,0,0-16,16V448H64V128H208a16,16,0,0,0,16-16V80a16,16,0,0,0-16-16H48A48,48,0,0,0,0,112V464a48,48,0,0,0,48,48H400a48,48,0,0,0,48-48V336A16,16,0,0,0,432,320ZM488,0h-128c-21.37,0-32.05,25.91-17,41l35.73,35.73L135,320.37a24,24,0,0,0,0,34L157.67,377a24,24,0,0,0,34,0L435.28,133.32,471,169c15,15,41,4.5,41-17V24A24,24,0,0,0,488,0Z" transform="translate(-256 -256)"></path></g></g></svg><!-- <span class="fas fa-external-link-alt" data-fa-transform="shrink-3 down-2"></span> Font Awesome fontawesome.com -->
                    <span class="d-none d-sm-inline-block ms-1">Export Stock</span>
                </button>
            </a>
        </div>
        <h4 class="text-dark text-center">Stock for this Branch:</h4>
        <div class="table-responsive">
            <table class="table data-table table-bordered table-striped table-hover fs--1 mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Product Name</th>
                        <th>Available Stock Quantity</th>
                        <th>Units</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($branch->productStocks as $stock)
                        <tr>
                            <td>{{ $stock->adminProduct->name }}</td> <!-- Display Product Name -->
                            <td>{{ $stock->available_quantity }}</td> <!-- Display Available Quantity from product_stock -->
                            <td>{{ $stock->adminProduct->units }}</td> <!-- Display Units from adminProduct -->
                            <td>{{ number_format($stock->adminProduct->price, 2) }}</td> <!-- Display Price -->
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
