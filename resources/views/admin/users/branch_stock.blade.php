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
