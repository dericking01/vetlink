@extends('layouts.admin.base')

@section('content')

<div class="card mb-3">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
          <h4 class="mb-3 fs-0">Customer Details</h4>
          <h5 class="mb-2">{{ $agent->name }}</h5>
          <p class="mb-0 fs--1"> <strong>Phone: </strong><a href="tel:+{{$agent->phone}}">{{$agent->phone}}</a></p>
          <p class="mb-0 fs--1"> <strong>Email: </strong><a href="mailto:{{ $agent->email }}">{{$agent->email}}</a></p>
          <p class="mb-1 fs--1">{{ $agent->location }}</p>
        </div>
        <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
          <h5 class="mb-3 fs-0">Points Details</h5>
          <h4 class="mb-2">{{ $agent->points }}</h4>
          <h5 class="mb-0 fs--1"> <strong>Promo Code:</strong><small class="badge fw-semi-bold rounded-pill badge-subtle-primary">{{ $agent->promo_code }}</small></h5>
          <p class="mb-0 fs--1"> <strong>Status</strong>
            @if($agent->status)
                <small class="badge fw-semi-bold rounded-pill badge-subtle-success">ACTIVE</small>
            @else
              <small class="badge fw-semi-bold rounded-pill badge-subtle-danger">INACTIVE</small>
            @endif
          </p>
        </div>
        @php
            $cash = $agent->points  * 1000;
        @endphp
        <div class="col-md-6 col-lg-4">
          <h5 class="mb-3 fs-0">Payment Details</h5>
          <div class="d-flex"><img class="me-3" src="../../../assets/img/icons/visa.png" width="40" height="30" alt="">
            <div class="flex-1">
              <h6 class="mb-0">{{$agent->name}}</h6>
              <p class="mb-2 fs--1">**** **** **** 9809</p>
              <h4 class="mb-2 text-success">Tsh {{ number_format($cash) }}/=</h4>
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
              <h5 class="mb-0" id="followers">Customer's Orders History</h5>
          </div>
            <div class="card-body">
                <div class="table-responsive scrollbar">
                <table class="table data-table table-bordered table-striped fs--1 mb-0">
                    <thead class="bg-200 text-900">
                    <tr>
                        <th class="sort pe-1 align-middle white-space-nowrap" data-sort="phone">Date</th>
                        <th class="sort pe-1 align-middle white-space-nowrap" data-sort="name">Buyer</th>
                        <th class="sort pe-1 align-middle white-space-nowrap" data-sort="name">Product</th>
                        <th class="sort pe-1 align-middle white-space-nowrap" data-sort="name">Qty</th>
                        <th class="sort pe-1 align-middle white-space-nowrap" data-sort="name">Discount</th>
                        <th class="sort pe-1 align-middle white-space-nowrap" data-sort="name">Amount</th>
                        <th class="sort pe-1 align-middle white-space-nowrap" data-sort="name">Points</th>
                    </tr>
                    </thead>
                    @php
                        $totalPoints = 0;
                        $totalAmount = 0;
                        $totalQuantity = 0;
                        $totalDiscount = 0;
                    @endphp

                    <tbody class="list">
                        @foreach($orders as $order)
                            @foreach($order->orderItems as $orderItem)
                                @if($orderItem->productable_type === 'App\Models\AdminProduct')
                                    @php
                                        $totalPoints += $orderItem->quantity;
                                        $totalAmount += $orderItem->amount;
                                        $totalQuantity += $orderItem->quantity;
                                        $totalDiscount += $orderItem->discount;
                                    @endphp

                                    <tr class="btn-reveal-trigger">
                                        <td class="joined align-middle py-2">{{ date_format(date_create($order->created_at), 'd M, Y') }}</td>
                                        <td class="joined py-2">{{ $orderItem->amount }}</td>
                                        <td class="joined py-2">
                                            @if ($orderItem->productable)
                                                {{ $orderItem->productable->name }}
                                            @else
                                                Product Not Available
                                            @endif
                                        </td>
                                        <td class="joined py-2">{{ $orderItem->quantity }}</td>
                                        <td class="joined py-2">{{ $orderItem->price }}</td>
                                        <td class="joined py-2">{{ $orderItem->amount }}</td>
                                        <td class="joined py-2">{{ $orderItem->quantity }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                        </tbody>

                        <!-- Display Total -->
                        <tr>
                            <td colspan="3"></td>
                            <td><b>{{ $totalQuantity }}</b></td>
                            <td><b>{{ $totalDiscount }}</b></td>
                            <td> <b>{{ $totalAmount }}</b></td>
                            <td><b>{{ $totalPoints }}</b></td>
                        </tr>

                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

@endsection
