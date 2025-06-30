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
            <button class="btn btn-falcon-default btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#distributeProducts" >
                    <svg class="svg-inline--fa fa-plus fa-w-14" data-fa-transform="shrink-3 down-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="" style="transform-origin: 0.4375em 0.625em;"><g transform="translate(224 256)"><g transform="translate(0, 64)  scale(0.8125, 0.8125)  rotate(0 0 0)"><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" transform="translate(-224 -256)"></path></g></g></svg><!-- <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span> Font Awesome fontawesome.com -->
                        <span class="d-none d-sm-inline-block ms-1">Distribute Products</span>
                </button>
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
                            <td>{{ number_format($stock->price, 2) }}</td> <!-- Display Price -->
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
<div class="modal fade" id="distributeProducts" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form action="{{ route('admin.branch.stockDistribution') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate="novalidate">
            @csrf
            <input type="hidden" name="sourceBranchId" value="{{ $branch->id }}" />
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                        data-bs-dismiss="modal" aria-label="Close" onclick="event.preventDefault();"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1" id="modalExampleDemoLabel">Distribute product </h4>
                    </div>
                    <div class="p-4 pb-0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="productSelect">Product</label>
                                    <select class="form-select js-choice" id="productSelect" size="1" required="required" name="product">
                                        <option value="">Select product...</option>
                                        @foreach ($productStocks as $product)
                                            <option value="{{ $product->admin_product_id }}">{{ $product->getName() }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Please select a product</div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="branchSelect">Branch Name(s)</label>
                                    <select class="form-select js-choice" id="branchSelect" multiple required="required" name="branches[]" onchange="toggleQuantityFields()">
                                        <option value="">Select branch...</option>
                                        @foreach ($branches as $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Please select at least one branch</div>
                                </div>
                            </div>

                            <!-- Quantity fields for each branch (initially hidden) -->
                            <div class="col-md-12">
                                @foreach ($branches as $branch)
                                    <div class="mb-3 branch-quantity" id="quantityField{{ $branch->id }}" style="display: none;">
                                        <label for="quantity{{ $branch->id }}">Quantity for {{ $branch->branch_name }}</label>
                                        <input class="form-control" id="quantity{{ $branch->id }}" name="quantities[{{ $branch->id }}]" type="number" placeholder="Enter quantity for {{ $branch->branch_name }}" />
                                    </div>
                                @endforeach
                            </div>


                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-info" type="submit">Submit </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
<script>
    function toggleQuantityFields() {
        // Hide all quantity fields initially
        document.querySelectorAll('.branch-quantity').forEach(function(quantityField) {
            quantityField.style.display = 'none';
            quantityField.querySelector('input').value = ''; // Clear the input value
        });

        // Get selected branches
        const selectedBranches = Array.from(document.getElementById('branchSelect').selectedOptions).map(option => option.value);

        // Show quantity fields for each selected branch
        selectedBranches.forEach(function(branchId) {
            const quantityField = document.getElementById('quantityField' + branchId);
            if (quantityField) {
                quantityField.style.display = 'block';
            }
        });
    }

    // Initialize quantity fields if the form is reloaded with old selections
    window.addEventListener('DOMContentLoaded', function() {
        toggleQuantityFields();
    });

    // Remove empty quantity fields before form submission
    document.getElementById('distribution-form').addEventListener('submit', function(e) {
        document.querySelectorAll('.branch-quantity').forEach(function(quantityField) {
            const input = quantityField.querySelector('input');
            if (input && input.value === '') {
                input.remove(); // Remove the empty input field
            }
        });
    });
</script>
