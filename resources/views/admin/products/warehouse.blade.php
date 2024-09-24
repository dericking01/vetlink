@extends('layouts.admin.base')

@section('content')


<div class="card">
  <div class="card-header bg-light">
    <div class="row align-items-center">
        <div class="col">
            <h5 class="mb-0" id="followers">Stock Distributions
              <span class="d-none d-sm-inline-block">({{ $branchProducts->count() }})</span>
                  </h5>
        </div>
        <div class="col text-end">
            <a class="font-sans-serif" href="#!" data-bs-toggle="modal" data-bs-target="#addproduct">
                <button class="btn btn-falcon-default btn-sm" type="button">
                    <svg class="svg-inline--fa fa-plus fa-w-14" data-fa-transform="shrink-3 down-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="" style="transform-origin: 0.4375em 0.625em;"><g transform="translate(224 256)"><g transform="translate(0, 64)  scale(0.8125, 0.8125)  rotate(0 0 0)"><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" transform="translate(-224 -256)"></path></g></g></svg><!-- <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span> Font Awesome fontawesome.com -->
                        <span class="d-none d-sm-inline-block ms-1">Distribute Products</span>
                </button>
            </a>
            <a class="font-sans-serif" href="{{ route('admin.products.export') }}">
                <button class="btn btn-falcon-default btn-sm" type="button"><svg class="svg-inline--fa fa-external-link-alt fa-w-16" data-fa-transform="shrink-3 down-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="external-link-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="transform-origin: 0.5em 0.625em;"><g transform="translate(256 256)"><g transform="translate(0, 64)  scale(0.8125, 0.8125)  rotate(0 0 0)"><path fill="currentColor" d="M432,320H400a16,16,0,0,0-16,16V448H64V128H208a16,16,0,0,0,16-16V80a16,16,0,0,0-16-16H48A48,48,0,0,0,0,112V464a48,48,0,0,0,48,48H400a48,48,0,0,0,48-48V336A16,16,0,0,0,432,320ZM488,0h-128c-21.37,0-32.05,25.91-17,41l35.73,35.73L135,320.37a24,24,0,0,0,0,34L157.67,377a24,24,0,0,0,34,0L435.28,133.32,471,169c15,15,41,4.5,41-17V24A24,24,0,0,0,488,0Z" transform="translate(-256 -256)"></path></g></g></svg><!-- <span class="fas fa-external-link-alt" data-fa-transform="shrink-3 down-2"></span> Font Awesome fontawesome.com -->
                    <span class="d-none d-sm-inline-block ms-1">Export</span>
                </button>
            </a>
          {{-- <a class="font-sans-serif" href="#!" data-bs-toggle="modal" data-bs-target="#addproduct">Add Product</a> --}}
        </div>

    </div>
</div>
    <div class="card-body">
      <div class="table-responsive scrollbar">
        <table class="table data-table table-bordered table-striped fs--1 mb-0">
          <thead class="bg-200 text-900">
            <tr>
              <th>SN.</th>
              <th>Date</th>
              <th>Product Name</th>
              <th>Branch Name</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Edit</th>
            </tr>
          </thead>
          <tbody class="list">
            @foreach ($branchProducts  as $key => $branchProduct)
            <tr>
              <td class="sn">{{ ++$key }}</td>
              <td class="date">{{ date_format(date_create($branchProduct->created_at), 'd M, Y') }}</td>
              <td class="name">
                <div class="d-flex align-items-center position-relative">
                    {{-- <img class="rounded-1 border border-200" src="{{ asset('upload/catalog/'.$product->image) }}" width="60" alt=""> --}}
                    <div class="flex-1 ms-3">
                        <h6 class="mb-1 fw-semi-bold text-nowrap">{{ $branchProduct->adminProduct->name }}</h6>
                    </div>
                </div>
              </td>
              <td class="name" style="text-align: center;">
                {{ $branchProduct->branch->branch_name }}
              </td>

              <td class="name">
                <div class="d-flex align-items-center position-relative">
                    <div class="flex-1 ms-3">
                        <h6 class="mb-1 fw-semi-bold text-nowrap">{{ number_format($branchProduct->adminProduct->price, 2) }}</h6>
                    </div>
                </div>
              </td>
              <td class="name">
                <div class="d-flex align-items-center position-relative">
                    <div class="flex-1 ms-3">
                        <h6 class="mb-1 fw-semi-bold text-nowrap">{{ number_format($branchProduct->quantity, 0) }}</h6>
                    </div>
                </div>
              </td>
              <td class="align-middle white-space-nowrap text-end">
                <div class="dropstart font-sans-serif position-static d-inline-block">
                    <button class="btn btn-link text-600 btn-sm dropdown-toggle
                      btn-reveal float-end" type="button" id="dropdown-simple-pagination-table-item-1"
                      data-bs-toggle="dropdown" data-boundary="window"
                      aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                        <span class="fas fa-ellipsis-h fs--1"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end border py-2"
                      aria-labelledby="dropdown-simple-pagination-table-item-1">
                      <a class="dropdown-item text-success" href="#!" data-bs-toggle="modal" data-bs-target="#editSender{{ $branchProduct->id }}">Edit</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item text-danger" href="#!" data-bs-toggle="modal" data-bs-target="#deleteSender{{ $branchProduct->id }}">Delete</a>
                    </div>
                </div>
              </td>
            </tr>

            <div class="modal fade" id="deleteSender{{ $branchProduct->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="{{ route('admin.distribution.destroy') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                <div class="modal-icon text-center mb-3">
                                    <i class="fas fa-trash text-danger fa-3x"></i>
                                </div>
                                <div class="modal-text text-center">
                                    <h2 class="text-danger">Confirm Delete</h2>
                                    <p>Are you sure you want to delete?</p>
                                    <input type="hidden" name="id" value="{{ $branchProduct->id }}" />
                                </div>
                            </div>
                            <div class="modal-footer text-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="editSender{{ $branchProduct->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <form action="{{ route('admin.distribution.update', ['id' => $branchProduct->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-content position-relative">
                            <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                                    data-bs-dismiss="modal" aria-label="Close" onclick="event.preventDefault();"></button>
                            </div>
                            <div class="modal-body p-0">
                                <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                                    <h4 class="mb-1" id="modalExampleDemoLabel">Edit distribution </h4>
                                </div>
                                <div class="p-4 pb-0">
                                    <div class="row">
                                        <!-- Hidden field for admin_product_id -->
                                        <input type="hidden" name="admin_product_id" value="{{ $branchProduct->adminProduct->id }}">

                                        <!-- Display the product name (this remains unchanged) -->
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="col-form-label" for="name">Product Name <span class="text-danger">*</span></label>
                                                <input class="form-control" name="product_name" readonly
                                                    id="name" type="text" value="{{ $branchProduct->adminProduct->name }}" />
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="col-form-label" for="quantity">Quantity <span class="text-danger">*</span>
                                                </label>
                                                <input class="form-control @error('quantity') is-invalid @enderror" name="quantity"
                                                    id="quantity" type="number" placeholder="Total product quantity" value="{{ $branchProduct->quantity }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="branch">Branch Name</label>
                                            <select class="form-control select2" id="branch{{ $branchProduct->id }}" name="branch_id">
                                                <option value="">Select branch...</option>
                                                @foreach ($branches as $branch)
                                                    <option value="{{ $branch->id }}" {{ old('branch_id', $branchProduct->branch_id) == $branch->id ? 'selected' : '' }}>
                                                        {{ $branch->branch_name }}
                                                    </option>
                                                @endforeach
                                            </select>
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


            @endforeach
          </tbody>
        </table>
      </div>
    </div>
</div>

<div class="modal fade" id="addproduct" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form action="{{ route('admin.products.distributeProduct') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate="novalidate">
            @csrf
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
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
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
