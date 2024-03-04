@extends('layouts.admin.base')

@section('content')

<div class="card mb-3">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
          <h4 class="mb-3 fs-0">Buyer Details</h4>
          <h5 class="mb-2">{{ $user->name }}</h5>
          <p class="mb-0 fs--1"> <strong>Phone: </strong><a href="tel:+{{$user->phone}}">{{$user->phone}}</a></p>
          <p class="mb-0 fs--1"> <strong>Email: </strong><a href="mailto:{{ $user->email }}">{{$user->email}}</a></p>
          <p class="mb-1 fs--1"> <strong>Location: </strong>{{ $user->location }}</p>
        </div>
        <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
          <h5 class="mb-3 fs-0">Buyer Profile</h5>
          <p class="mb-0 fs--1"> <strong>Status:</strong>
                <small class="badge fw-semi-bold rounded-pill badge-subtle-success">ACTIVE</small>
          </p>
          <h5 class="mb-0 fs--1"> <strong>Join Date:</strong><small class="badge fw-semi-bold rounded-pill badge-subtle-primary">{{ $user->created_at }}</small></h5>
          <h5 class="mb-0 fs--1"> <strong>Gender:</strong><small class="badge fw-semi-bold rounded-pill badge-subtle-primary">{{ $user->gender }}</small></h5>
          <?php
                // Convert date of birth to DateTime object
                $dob = new DateTime($user->date_of_birth);

                // Get current date
                $today = new DateTime();

                // Calculate difference
                $age = $today->diff($dob)->y;
            ?>
          <h5 class="mb-0 fs--1"> <strong>Age:</strong><small class="badge fw-semi-bold rounded-pill badge-subtle-primary">{{ $age}} Years</small></h5>
        </div>

      </div>
    </div>
  </div>

<div class="card">
    <div class="card-header bg-light">
      <div class="row align-items-center">
          <div class="col">
              <h5 class="mb-0" id="followers">Buyer's Orders History</h5>
          </div>
            <div class="card-body">
                <div class="table-responsive scrollbar">
                <table class="table data-table table-bordered table-striped fs--1 mb-0">
                    <thead class="bg-200 text-900">
                    <tr>
                        <th class="sort pe-1 align-middle white-space-nowrap" data-sort="phone">Date</th>
                        <th class="sort pe-1 align-middle white-space-nowrap" data-sort="name">Supplier</th>
                        <th class="sort pe-1 align-middle white-space-nowrap" data-sort="name">Product</th>
                        <th class="sort pe-1 align-middle white-space-nowrap" data-sort="name">Qty</th>
                        <th class="sort pe-1 align-middle white-space-nowrap" data-sort="name">Discount</th>
                        <th class="sort pe-1 align-middle white-space-nowrap" data-sort="name">Amount</th>
                        <th class="sort pe-1 align-middle white-space-nowrap" data-sort="name">Status</th>
                    </tr>
                    </thead>
                    @php
                        $totalAmount = 0;
                        $totalQuantity = 0;
                        $totalDiscount = 0;
                    @endphp

                    <tbody class="list">
                        @foreach($orders as $order)
                            @foreach($order->orderItems as $orderItem)
                                @if($orderItem->productable_type === 'App\Models\Product')
                                    @php
                                        $totalAmount += $orderItem->amount;
                                        $totalQuantity += $orderItem->quantity;
                                        $totalDiscount += $orderItem->discount;
                                    @endphp

                                    <tr class="btn-reveal-trigger">
                                        <td class="joined align-middle py-2">{{ date_format(date_create($order->created_at), 'd M, Y') }}</td>
                                        <td class="joined py-2">{{ $orderItem->seller->name }}</td>
                                        <td class="joined py-2">
                                            @if ($orderItem->productable)
                                                {{ $orderItem->productable->name }}
                                            @else
                                                Product Not Available
                                            @endif
                                        </td>
                                        <td class="joined py-2">{{ $orderItem->quantity }}</td>
                                        <td class="joined py-2">{{ $orderItem->discount }}</td>
                                        <td class="joined py-2">{{ $orderItem->amount }}</td>
                                        <td class="joined py-2">
                                            @if ($order->status == 'Completed')
                                            <small class="badge fw-semi-bold rounded-pill badge-subtle-success">{{ $order->status }}</small>
                                            @else
                                            <small class="badge fw-semi-bold rounded-pill badge-subtle-danger">{{ $order->status }}</small>
                                            @endif
                                        </td>
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
                         <!--   <td><b> totalPoints </b></td> -->
                        </tr>

                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

@endsection
