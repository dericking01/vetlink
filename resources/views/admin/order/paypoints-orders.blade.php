@extends('layouts.admin.base')

@section('content')


<div class="card">
  <div class="card-header bg-light">
    <div class="row align-items-center">
        <div class="col">
            <h5 class="mb-0" id="followers">Pay-Point Orders
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
              {{-- <th>Buyer</th> --}}
              <th>Customer</th>
              <th>Branch</th>
              <th>PayPoints</th>
              <th>Debt</th>
              <th>Delivered</th>
              <th class="text-center" >Payment Status</th>
              {{-- <th>Action</th> --}}
            </tr>
          </thead>
          <tbody class="list">
            @foreach ($orders as $key => $order)
            <tr>
              <td class="sn">
                <a href="{{ route('admin.orders.vieworder', $order->id) }}">
                {{ ++$key }}
                </a>
              </td>
              <td class="date">{{ date_format(date_create($order->created_at), 'd M, Y') }}</td>
              <td class="service_category">
                    {{ $order->agent->name }}
              </td>
              <td class="service_category">{{ $order->branch->branch_name }}</td>

              {{-- <td class="quantity">
                @foreach ($order->orderItems as $orderItem)
                    {{ $orderItem->quantity }}
                @endforeach
              </td> --}}
              <td class="amount">{{ number_format ($order->PayPoint, 2) }}</td>
              <td class="quantity">{{ number_format ($order->total_amount - $order->PayPoint) }}</td>
              @if ($order->isDelivered)
              <td class="status text-center">
                <span class="badge badge-subtle-success">YES</span>
              </td>
              @else
              <td class="status text-center">
                <span class="badge badge-subtle-danger">NO</span>
              </td>
              @endif

              @if ($order->PayPoint == $order->total_amount)
              <td class="status text-center">
                <span class="badge badge-subtle-success">DONE</span>
              </td>
              @else
              <td class="status text-center">
                <span class="badge badge-subtle-warning">PENDING</span>
              </td>
              @endif
              {{-- <td class="align-middle white-space-nowrap text-end">
                <div class="dropstart font-sans-serif position-static d-inline-block">
                    <button class="btn btn-link text-600 btn-sm dropdown-toggle
                      btn-reveal float-end" type="button" id="dropdown-simple-pagination-table-item-1"
                      data-bs-toggle="dropdown" data-boundary="window"
                      aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                        <span class="fas fa-ellipsis-h fs--1"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end border py-2"
                      aria-labelledby="dropdown-simple-pagination-table-item-1">
                      <a class="dropdown-item text-primary" href="{{ route('admin.orders.vieworder', $order->id) }}">View</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item text-success" href="#!" data-bs-toggle="modal" data-bs-target="#editPendingOrder{{ $order->id }}">Edit</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item text-danger" href="#!" data-bs-toggle="modal" data-bs-target="#deletePendingOrder{{ $order->id }}">Delete</a>
                    </div>
                  </div>
              </td> --}}
            </tr>

            {{-- Delete Pending Orders Modal --}}
            <div class="modal fade" id="deletePendingOrder{{ $order->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.order.destroy') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                <div class="modal-icon text-center mb-3">
                                    <i class="fas fa-trash text-danger fa-3x"></i>
                                </div>
                                <div class="modal-text text-center">
                                    <h2 class="text-danger">Confirm Delete</h2>
                                    <p>Are you sure you want to delete?</p>
                                    <input type="hidden" name="id" value="{{ $order->id }}" />
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

            {{-- Edit Pending Orders Modal --}}
            <div class="modal fade" id="editPendingOrder{{ $order->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <form action="{{ route('admin.partialOrder.update', ['id' => $order->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-content position-relative">
                            <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                                        data-bs-dismiss="modal" aria-label="Close" onclick="event.preventDefault();"></button>
                            </div>
                            <div class="modal-body p-0">
                                <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                                    <h4 class="mb-1" id="modalExampleDemoLabel">Edit Order </h4>
                                </div>
                                <div class="p-4 pb-0">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="col-form-label" for="buyer_name">Customer Name <span class="text-danger"></span></label>
                                                <input class="form-control" name="name" id="name" type="text" value="{{ $order->agent->name }}" readonly />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="col-form-label" for="amount">Amount <span class="text-danger"></span></label>
                                                <input class="form-control" name="amount" id="amount{{ $order->id }}" type="number" value="{{ $order->total_amount }}" readonly />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="status">Delivery Status <span class="text-danger">*</span></label>
                                            <select class="form-select" id="organizerSingle2" size="1" name="isDelivered">
                                                <option value="0" {{ old('isDelivered', $order->isDelivered) == '0' ? 'selected' : '' }}>No</option>
                                                <option value="1" {{ old('isDelivered', $order->isDelivered) == '1' ? 'selected' : '' }}>Yes</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="organizerSingle2">Branch Name</label>
                                            <select class="form-control select2" id="branch{{ $order->id }}" name="branch">
                                                <option value="">Select branch...</option>
                                                @foreach ($branches as $branch)
                                                    <option value="{{ $branch->id }}" {{ old('branch', $selectedBranchIds[$order->id] ?? null) == $branch->id ? 'selected' : '' }}>{{ $branch->branch_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="status">Payment Status <span class="text-danger">*</span></label>
                                            <input class="form-control" name="amount" id="amount{{ $order->id }}" value="{{ $order->status === 'Partial' ? 'PARTIAL' : $order->status }}" readonly />
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3" id="partialAmountField{{ $order->id }}" >
                                                <label for="status">Partial Amount<span class="text-danger">*</span></label>
                                                <input class="form-control" name="partial_amount" id="partial_amount{{ $order->id }}" type="number" placeholder="Partial amount" value="{{ old('partial_amount', $order->partial_amt) }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 modal-footer">
                                <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-info" type="submit">Submit</button>
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
@endsection

<script>
    function togglePartialAmountField(orderId, selectElement) {
        console.log('Order ID:', orderId);
        console.log('Selected status:', selectElement.value);

        var partialAmountField = document.getElementById('partialAmountField' + orderId);
        console.log('Partial amount field ID:', 'partialAmountField' + orderId);

        if (selectElement.value === 'Partial') {
            console.log('Showing partial amount field for order ID:', orderId);
            partialAmountField.style.display = 'block';
        } else {
            console.log('Hiding partial amount field for order ID:', orderId);
            partialAmountField.style.display = 'none';
        }
    }

    window.addEventListener('DOMContentLoaded', function() {
        console.log('DOM fully loaded and parsed');

        @foreach ($orders as $order)
            console.log('Initial check for order ID:', {{ $order->id }});
            togglePartialAmountField({{ $order->id }}, document.getElementById('status{{ $order->id }}'));
        @endforeach
    });

    document.querySelector('form').addEventListener('submit', function(event) {
        @foreach ($orders as $order)
            var partialAmountValue = document.querySelector('#partialAmountField{{ $order->id }} input').value;
            console.log('Partial amount for order ID {{ $order->id }}:', partialAmountValue);
        @endforeach
    });
</script>

