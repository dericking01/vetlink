@extends('layouts.admin.base')

@section('content')

<div class="card mb-3">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
          <h4 class="mb-3 fs-0">Seller Details</h4>
          <h5 class="mb-2">{{ $seller->name }}</h5>
          <p class="mb-0 fs--1"> <strong>Phone: </strong><a href="tel:+{{$seller->phone}}">{{$seller->phone}}</a></p>
          <p class="mb-0 fs--1"> <strong>Email: </strong><a href="mailto:{{ $seller->email }}">{{$seller->email}}</a></p>
          <p class="mb-1 fs--1"> <strong>Location: </strong>{{ $seller->location }}</p>
        </div>
        <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
          <h5 class="mb-3 fs-0">Seller Status</h5>
          <p class="mb-0 fs--1"> <strong>Status:</strong>
            @if($seller->status == "APPROVED")
                <small class="badge fw-semi-bold rounded-pill badge-subtle-success">APPROVED</small>
            @elseif ($seller->status == "PENDING")
                <small class="badge fw-semi-bold rounded-pill badge-subtle-warning">PENDING</small>
            @else
              <small class="badge fw-semi-bold rounded-pill badge-subtle-danger">REJECTED</small>
            @endif
          </p>
          <h5 class="mb-0 fs--1"> <strong>Join Date:</strong><small class="badge fw-semi-bold rounded-pill badge-subtle-primary">{{ $seller->created_at }}</small></h5>
          <h5 class="mb-0 fs--1"> <strong>Gender:</strong><small class="badge fw-semi-bold rounded-pill badge-subtle-primary">{{ $seller->gender }}</small></h5>
          <?php
                // Convert date of birth to DateTime object
                $dob = new DateTime($seller->date_of_birth);

                // Get current date
                $today = new DateTime();

                // Calculate difference
                $age = $today->diff($dob)->y;
            ?>
          <h5 class="mb-0 fs--1"> <strong>Age:</strong><small class="badge fw-semi-bold rounded-pill badge-subtle-primary">{{ $age}} Years</small></h5>
        </div>

        <div class="col-md-6 col-lg-4">
          <h5 class="mb-3 fs-0">Payment Details</h5>
          <div class="d-flex"><img class="me-3" src="../../../assets/img/icons/visa.png" width="40" height="30" alt="">
            <div class="flex-1">
              <h6 class="mb-0">{{$seller->name}}</h6>
              <p class="mb-2 fs--1">**** **** **** 9809</p>
              <h4 class="mb-2 text-success">Tsh {{$totalProductPrice}}/=</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<div class="card">
    <div class="card-header bg-light">
      <div class="row align-items-center">
          <div class="col">
              <h5 class="mb-0" id="followers">Seller Uploads
                <span class="d-none d-sm-inline-block">({{ $products->count() }})</span>
                    </h5>
          </div>
          <div class="col text-end">
              <a class="font-sans-serif" href="#!" data-bs-toggle="modal" data-bs-target="#addproductcat">
                  <button class="btn btn-falcon-default btn-sm" type="button"><svg class="svg-inline--fa fa-external-link-alt fa-w-16" data-fa-transform="shrink-3 down-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="external-link-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="transform-origin: 0.5em 0.625em;"><g transform="translate(256 256)"><g transform="translate(0, 64)  scale(0.8125, 0.8125)  rotate(0 0 0)"><path fill="currentColor" d="M432,320H400a16,16,0,0,0-16,16V448H64V128H208a16,16,0,0,0,16-16V80a16,16,0,0,0-16-16H48A48,48,0,0,0,0,112V464a48,48,0,0,0,48,48H400a48,48,0,0,0,48-48V336A16,16,0,0,0,432,320ZM488,0h-128c-21.37,0-32.05,25.91-17,41l35.73,35.73L135,320.37a24,24,0,0,0,0,34L157.67,377a24,24,0,0,0,34,0L435.28,133.32,471,169c15,15,41,4.5,41-17V24A24,24,0,0,0,488,0Z" transform="translate(-256 -256)"></path></g></g></svg><!-- <span class="fas fa-external-link-alt" data-fa-transform="shrink-3 down-2"></span> Font Awesome fontawesome.com -->
                      <span class="d-none d-sm-inline-block ms-1">Export</span>
                  </button>
              </a>
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
                <th>ProductName</th>
                <th>UnitPrice</th>
                <th>Quantity</th>
                <th>Wholesale Qty</th>
                <th>Discount</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody class="list">
              @foreach ($products as $key => $product)
              <tr>
                <td class="sn">{{ ++$key }}</td>
                <td class="date">{{ date_format(date_create($product->created_at), 'd M, Y') }}</td>
                <td class="name">
                  <div class="d-flex align-items-center position-relative"><img class="rounded-1 border border-200" src="{{ asset('upload/catalog/'.$product->image) }}" width="60" alt="">
                    <div class="flex-1 ms-3">
                      <h6 class="mb-1 fw-semi-bold text-nowrap"><a class="text-900 stretched-link" href="{{ route('admin.marketproducts.details', $product->id) }}">{{ $product->name }}</a></h6>
                      <p class="fw-semi-bold mb-0 text-500">{{ $product->name }}</p>
                    </div>
                  </div>
                </td>
                <td class="price">{{ number_format($product->price, 2) }}</td>
                <td class="quantity">{{ $product->quantity }}</td>
                <td class="wholesale_minimum_qty">{{ $product->wholesale_minimum_qty }}</td>
                <td class="discount">{{ number_format($product->discount, 2) }}</td>
                @if ($product->status == true)
                <td class="status">
                  <span class="badge badge-subtle-success">Active</span>
                </td>
                @else
                <td class="status">
                  <span class="badge badge-subtle-danger">Inactive</span>
                </td>
                @endif
              </tr>

              @endforeach
            </tbody>
          </table>
        </div>
      </div>
  </div>

@endsection
