@extends('layouts.staff.stock-auditor-base')

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
            <a class="font-sans-serif" href="#">
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
            </tr>

            @endforeach
          </tbody>
        </table>
      </div>
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
