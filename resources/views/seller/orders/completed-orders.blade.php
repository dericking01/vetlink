@extends('layouts.seller.base')

@section('content')


<div class="card">
  <div class="card-header bg-light">
    <div class="row align-items-center">
        <div class="col">
            <h5 class="mb-0" id="followers">Completed Orders
              <span class="d-none d-sm-inline-block">({{ $orders->count() }})</span>
                  </h5>
        </div>
        <div class="col text-end">
            <a class="font-sans-serif" href="#!" data-bs-toggle="modal" data-bs-target="#addproduct">

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
              <th>Buyer</th>
              <th>Agent</th>
              <th>Qty</th>
              <th>Amount</th>
              <th>Commission</th>
              <th>Delivery</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody class="list">
            @foreach ($orders as $key => $order)
            <tr>
              <td class="sn">{{ ++$key }}</td>
              <td class="date">{{ date_format(date_create($order->created_at), 'd M, Y') }}</td>
              <td class="service_category">{{ $order->user->name }}</td>
              <td class="service_category">{{ $order->agent->name }}</td>
              <td class="quantity">{{ $order->totalQtyForSeller }}</td>
              <td class="price">{{ number_format($order->totalAmountForSeller, 2) }}</td>
              <td class="discount">{{ number_format ($order->totalCommissionForSeller, 2) }}</td>
              @if ($order->isDelivered)
              <td class="status text-center">
                <span class="badge badge-subtle-success">YES</span>
              </td>
              @else
              <td class="status text-center">
                <span class="badge badge-subtle-danger">NO</span>
              </td>
              @endif
              <td class="status text-center">
                <span class="badge badge-subtle-success">COMPLETED</span>
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
                      <a class="dropdown-item text-primary" href="{{ route('seller.viewOrder', $order->id) }}">View</a>
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
