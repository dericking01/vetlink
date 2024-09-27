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

    <!-- Product Distribution Table -->
    <div class="card shadow-sm p-3 mb-4 bg-light rounded">
        <h4 class="text-dark text-center">Product Distributions for this Branch:</h4>
        <div class="table-responsive">
            <table class="table data-table table-bordered table-striped table-hover fs--1 mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity Distributed</th>
                        <th>Units</th>
                        <th>Price</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($branch->branchProducts as $distribution)
                        <tr>
                            <td>{{ $distribution->adminProduct->name }}</td>
                            <td>{{ $distribution->quantity }}</td>
                            <td>{{ $distribution->adminProduct->units }}</td>
                            <td>{{ number_format($distribution->adminProduct->price, 2) }}</td>
                            <td>
                                @if ($distribution->adminProduct->description)
                                    {{ $distribution->adminProduct->description }}
                                @else
                                    <span class="badge badge-subtle-primary">NONE</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
