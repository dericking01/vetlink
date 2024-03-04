@extends('layouts.admin.base')

@section('content')

<div class="card">
    <div class="card-header bg-light">
      <div class="row align-items-center">
          <div class="col">
              <h5 class="mb-0" id="followers">Pending Invoices
                <span class="d-none d-sm-inline-block">({{ $invoices->count() }})</span>
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
                <th>Discount</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody class="list">
              @foreach ($invoices as $key => $invoice)
              <tr>
                <td class="sn">{{ ++$key }}</td>
                <td class="date">{{ date_format(date_create($invoice->created_at), 'd M, Y') }}</td>
                <td class="service_category">{{ $invoice->order->user->name }}</td>
                <td class="service_category">{{ $invoice->order->agent->name }}</td>

                <td class="quantity">{{$invoice->TotalQty}}</td>
                <td class="price">{{ $invoice->TotalAmt }}</td>
                <td class="discount">{{ $invoice->discount }}</td>
                <td class="status text-center">
                    <span class="badge badge-subtle-warning">PENDING</span>
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
                        <a class="dropdown-item text-primary" href="{{ route('admin.orders.vieworder', $invoice->id) }}">View</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="#!" data-bs-toggle="modal" data-bs-target="#deletePendingInvoice{{ $invoice->id }}">Delete</a>
                      </div>
                    </div>
                </td>
              </tr>

              {{-- Delete Pending Invoice Modal --}}
              <div class="modal fade" id="deletePendingInvoice{{ $invoice->id }}" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>

                          <form action="{{ route('admin.pendingInvoice.destroy') }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <div class="modal-body">
                                  <div class="modal-icon text-center mb-3">
                                      <i class="fas fa-trash text-danger fa-3x"></i>
                                  </div>
                                  <div class="modal-text text-center">
                                      <h2 class="text-danger">Confirm Delete</h2>
                                      <p>Are you sure you want to delete?</p>
                                      <input type="hidden" name="id" value="{{ $invoice->id }}" />
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

              @endforeach
            </tbody>
          </table>
        </div>
      </div>
  </div>

@endsection
