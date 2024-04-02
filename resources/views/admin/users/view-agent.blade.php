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
          <p class="mb-1 fs--1"> <strong>Location:</strong> {{ $agent->location }}</p>
          <p class="mb-1 fs--1">
            <strong>Gender:</strong>
            @if ($agent->gender == 'M')
                MALE
            @else
                FEMALE
            @endif
         </p>

        </div>
        <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
          <h5 class="mb-3 fs-0">Points Details</h5>
          <h4 class="mb-2">{{ $agent->points }}</h4>
          <p class="mb-0 fs--1"> <strong>Promo Code: </strong><small class="badge fw-semi-bold rounded-pill badge-subtle-primary">{{ $agent->promo_code }}</small></p>
          <p class="mb-0 fs--1"> <strong>Joined Date: </strong><small class="badge fw-semi-bold rounded-pill badge-subtle-primary">{{ $agent->created_at }}</small></p>
          <p class="mb-0 fs--1"> <strong>Status:</strong>
            @if($agent->status)
                <small class="badge fw-semi-bold rounded-pill badge-subtle-success">ACTIVE</small>
            @else
              <small class="badge fw-semi-bold rounded-pill badge-subtle-danger">INACTIVE</small>
            @endif
          </p>
        </div>
        @php
            $cash = $agent->points  / 6.5;
        @endphp
        <div class="col-md-6 col-lg-4">
          <h5 class="mb-3 fs-0">Card Details</h5>
          <div class="d-flex"><img class="me-3" src="../../../assets/img/icons/visa.png" width="70" height="70" alt="">
            <div class="flex-1">
              <h6 class="mb-0">{{$agent->name}}</h6>
              <a href="{{ route('agent.view-agent_card', $agent->id) }}">
                <p class="mb-2 fs--1"> {{$agent->agent_id}} </p>
              </a>
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
                        <th class="sort pe-1 align-middle white-space-nowrap" data-sort="name">Amount (Tshs)</th>
                        <th class="sort pe-1 align-middle white-space-nowrap" data-sort="name">Status</th>
                        <th class="sort pe-1 align-middle white-space-nowrap" data-sort="name">Delivered</th>
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
                            @php
                                $totalAmount += $order->total_amount;

                            @endphp

                            <tr class="btn-reveal-trigger">
                                <td class="joined align-middle py-2">{{ date_format(date_create($order->created_at), 'd M, Y') }}</td>
                                <td class="joined py-2">{{ number_format($order->total_amount) }}</td>
                                <td class="joined py-2"><span class="badge badge-subtle-success">{{ $order->status }}</span></td>
                                @if ($order->isDelivered)
                                <td class="status text-center">
                                    <span class="badge badge-subtle-success">YES</span>
                                </td>
                                @else
                                <td class="status text-center">
                                    <span class="badge badge-subtle-danger">NO</span>
                                </td>
                                @endif
                        @endforeach
                            <tr>
                            <!-- Display Total -->
                                <td> <b>TOTAL AMOUNT</b></td>
                                <td> <b>{{ number_format($totalAmount) }}</b></td>
                            </tr>
                    </tbody>

                </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
