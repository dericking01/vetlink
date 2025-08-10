@extends('layouts.admin.base')

@section('content')
<div class="card mb-3">
    <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../../../assets/img/icons/spot-illustrations/corner-4.png);opacity: 0.7;"></div>
    <!--/.bg-holder-->
    <div class="card-body position-relative">
      <h5>Order Details: #00{{$order->id}} </h5>
      <p class="fs--1">{{ date_format(date_create($order->sale_date), 'F j, Y, g:i A') }}</p>
      <div class="d-flex align-items-center">
        <strong class="me-2">Payment Status:</strong>
        @if ($order->status == 'Pending')
            <span class="badge badge-subtle-warning d-flex align-items-center">Pending <i class="fas fa-spinner ms-1" aria-hidden="true"></i></span>
        @elseif($order->status == 'Completed')
            <span class="badge badge-subtle-success d-flex align-items-center">Completed <i class="fa fa-check-circle ms-1" aria-hidden="true"></i></span>
        {{-- @else --}}
        @elseif($order->status == 'Partial')
            <span class="badge badge-subtle-warning d-flex align-items-center">Partially Paid <i class="fa fa-spinner fa-spin ms-1" aria-hidden="true"></i></span>
        @elseif($order->status == 'PayPoint')
            <span class="badge badge-subtle-primary d-flex align-items-center">Paid By Points <i class="fa fa-barcode ms-1" aria-hidden="true"></i></span>
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
          <h6 class="mb-2">{{ $order->agent->name }}</h6>
          <p class="mb-0 fs--1">{{ $order->agent->location }}</p>
          <div class="text-500 fs--1">
            {{-- (Free Shipping --}}
        </div>
        </div>
        {{-- <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
          <h5 class="mb-3 fs-0">Shipping Address</h5>
          <h6 class="mb-2">{{ $order->agent->location }}</h6>
          <p class="mb-0 fs--1">{{ $order->user->location }}</p>
          <div class="text-500 fs--1">
            (Free Shipping)
        </div>
        </div> --}}
        <div class="col-md-6 col-lg-4">
          <h5 class="mb-3 fs-0">Card</h5>
          <div class="d-flex"><img class="me-3" src="../../../assets/img/icons/visa.png" width="40" height="30" alt="">
            <div class="flex-1">
              <h6 class="mb-0">DODOKI CARD</h6>
              <p class="mb-0 fs--1"> {{$order->agent->agent_id}} </p>
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
              {{-- <th class="border-0">Sellers</th> --}}
              <th class="border-0 text-center">Quantity</th>
              <th class="border-0 text-end">Price</th>
              {{-- <th class="border-0 text-end">Commission</th> --}}
              <th class="border-0 text-end">Amount</th>
              <th class="border-0 text-end">Action</th>
            </tr>
          </thead>
            <tbody>
                @php
                    $grandTotal = 0; // Initialize the grand total
                @endphp
                @foreach($products as $key => $product)

                    @php
                        // Calculate the amount for each product
                        $amount = ($product['price']) * ($product['quantity']);
                        $grandTotal += $amount;
                    @endphp

                    <tr class="border-200">
                        <td class="align-middle">
                            <h6 class="mb-0 text-nowrap">{{ $product['name'] }}</h6>
                            <p class="mb-0">
                                Dodoki Product <!-- This should always be true for your context -->
                            </p>
                        </td>
                        <td class="align-middle text-center">{{ $product['quantity'] }}</td>
                        <td class="align-middle text-end">{{ number_format($product['price'], 2) }}</td>
                        <td class="align-middle text-end">{{ number_format($amount, 2) }}</td>
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
                      <a class="dropdown-item text-success" href="#!" data-bs-toggle="modal" data-bs-target="#editPendingOrder{{ $order->id }}">Edit</a>
                    </div>
                  </div>
              </td>
                    </tr>



                     {{-- Edit Pending Orders Modal --}}
            <div class="modal fade" id="editPendingOrder{{ $order->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <form action="{{ route('admin.order.orderitem.update', ['id' => $order->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        {{-- ORDER ITEMS --}}
                                        @foreach ($order->orderItems as $item)
                                        <div>
                                            <input type="hidden" class="form-control" id="quantity{{ $item->id }}" name="quantities[{{ $item->id }}]" value="{{ $item->quantity }}" required>
                                        </div>
                                        @endforeach
                        <div class="modal-content position-relative">
                            <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                                    data-bs-dismiss="modal" aria-label="Close" onclick="event.preventDefault();"></button>
                            </div>
                            <div class="modal-body p-0">
                                <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                                    <h4 class="mb-1" id="modalExampleDemoLabel">Edit Order Item </h4>
                                </div>
                                <div class="p-4 pb-0">
                                    <div class="row">
                                        <div class="col">

                                            <!-- <div class="mb-3">
                                                <label class="col-form-label" for="qauntity">Quantity <span class="text-danger"></span></label>
                                                <input class="form-control " name="qauntity" id="qauntity"
                                                    type="number" placeholder="Quantity" value="{{ $item->quantity }}" readonly/>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">

                                            <div class="mb-3">
                                                <label class="col-form-label" for="price">Price <span class="text-danger"></span></label>
                                                <input class="form-control " name="price" id="price"
                                                    type="number" placeholder="Price" value="{{ $item->price }}" readonly/>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="mt-3 modal-footer">
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
      <div class="row g-0 justify-content-end">
        <div class="col-auto">
            <table class="table table-sm table-borderless fs--1 text-end">
                <tbody>
                    <tr>
                        <th class="text-600">DISCOUNT AMOUNT:</th>
                        <td class="fw-semi-bold">Tsh {{ number_format($order->discount) }}</td>
                    </tr>
                    <tr>
                        <th class="text-900">TOTAL AMOUNT:</th>
                        <td class="fw-semi-bold">Tsh {{ number_format($order->total_amount) }}</td>
                    </tr>

                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
@endsection
