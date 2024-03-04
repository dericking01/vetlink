@extends('layouts.seller.base')

@section('content')
<div class="card mb-3">
    <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../../../assets/img/icons/spot-illustrations/corner-4.png);opacity: 0.7;"></div>
    <!--/.bg-holder-->
    <div class="card-body position-relative">
      <h5>Order Details: #00{{$order->id}} </h5>
      <p class="fs--1">{{ date_format(date_create($order->created_at), 'F j, Y, g:i A') }}</p>
      <div class="d-flex align-items-center">
        <strong class="me-2">Status:</strong>
        @if ($order->status == 'Pending')
            <span class="badge badge-subtle-warning d-flex align-items-center">Pending <i class="fas fa-spinner ms-1" aria-hidden="true"></i></span>
        @elseif($order->status == 'Completed')
            <span class="badge badge-subtle-success d-flex align-items-center">Completed <i class="fa fa-check-circle ms-1" aria-hidden="true"></i></span>
        @else
            <span class="badge badge-subtle-danger d-flex align-items-center">Rejected <i class="fa fa-times-circle ms-1" aria-hidden="true"></i></span>
        @endif
    </div>

    </div>
  </div>

  <div class="card mb-3">
    <div class="card-body">
      <div class="row">
        {{-- <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
          <h5 class="mb-3 fs-0">Billing Address</h5>
          <h6 class="mb-2">{{ $order->seller->name }}</h6>
          <p class="mb-1 fs--1">{{ $order->seller->location }}</p>
          <p class="mb-0 fs--1"> <strong>Email: </strong><a href="mailto:{{ $order->seller->email }}">{{$order->seller->email}}</a></p>
          <p class="mb-0 fs--1"> <strong>Phone: </strong><a href="tel:+{{$order->seller->phone}}">{{$order->seller->phone}}</a></p>
        </div> --}}
        <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
          <h5 class="mb-3 fs-0">Billing Address</h5>
          <h6 class="mb-2">{{ $order->user->name }}</h6>
          <p class="mb-0 fs--1">{{ $order->user->location }}</p>
          <div class="text-500 fs--1">
            {{-- (Free Shipping --}}
        </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
          <h5 class="mb-3 fs-0">Shipping Address</h5>
          <h6 class="mb-2">{{ $order->user->name }}</h6>
          <p class="mb-0 fs--1">{{ $order->user->location }}</p>
          <div class="text-500 fs--1">
            (Free Shipping)
        </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <h5 class="mb-3 fs-0">Payment Method</h5>
          <div class="d-flex"><img class="me-3" src="../../../assets/img/icons/visa.png" width="40" height="30" alt="">
            <div class="flex-1">
              <h6 class="mb-0">Antony Hopkins</h6>
              <p class="mb-0 fs--1">**** **** **** 9809</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card mb-3">
    <div class="card-body">
      <div class="table-responsive fs--1">
        <table class="table table-striped border-bottom">
          <thead class="bg-200 text-900">
            <tr>
              <th class="border-0">Products</th>
              <th class="border-0">Sellers</th>
              <th class="border-0 text-center">Quantity</th>
              <th class="border-0 text-end">Price</th>
              <th class="border-0 text-end">Commission</th>
              <th class="border-0 text-end">Amount</th>
            </tr>
          </thead>
          <tbody>
            @foreach($orderItems as $key => $orderItem)

            @php
            // Get the corresponding product for this order item
                $product = $orderItem->productable;
                $subtotal = $orderItems->sum('amount');

            @endphp

            <tr class="border-200">
              <td class="align-middle">
                <h6 class="mb-0 text-nowrap">{{ $product->name }}</h6>
                <p class="mb-0">
                    @if($orderItem->productable_type == 'App\Models\Product')
                        SAB Product
                    @else
                        Market Product
                    @endif
                </p>
              </td>
              <td class="align-middle">{{$orderItem->seller->name}}</td>
              <td class="align-middle text-center">{{$orderItem->quantity}}</td>
              <td class="align-middle text-end"> {{number_format($product->price ,2)}}</td>
              <td class="align-middle text-end">{{number_format($orderItem->sab_commission ,2) }}</td>
              <td class="align-middle text-end">{{ number_format($orderItem->amount ,2) }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="row g-0 justify-content-end">
        <div class="col-auto">
            <table class="table table-sm table-borderless fs--1 text-end">
                <tbody>
                    @php
                        $subTotal = $orderItems->sum('amount');
                        $SabTax = $orderItems->sum('sab_commission');
                        $total = $subTotal - $SabTax;
                        
                    @endphp
                    <tr>
                        <th class="text-900">Subtotal:</th>
                        <td class="fw-semi-bold">{{ number_format($subTotal ,2) }}</td>
                    </tr>
                    <tr>
                        <th class="text-900">SAB Tax 2%:</th>
                        <td class="fw-semi-bold">{{ number_format($SabTax ,2) }}</td>
                    </tr>
                    <tr   tr class="border-top">
                        <th class="text-900">Total:</th>
                        <td class="fw-bold">Tsh {{ number_format($total ,2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
@endsection
