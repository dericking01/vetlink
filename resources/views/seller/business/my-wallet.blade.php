@extends('layouts.seller.base')

@section('content')

<div class="row align-items-center mb-3">
    <div class="col">
        <h4 class="mb-0" id="followers">
            <span class="page-header-icon">
                <img src="https://6ammart-admin.6amtech.com/public/assets/admin/img/wallet.png" class="w--26" alt="">
            </span>
             Store Wallet
        </h4>
    </div>
</div>


<div class="row g-2">
    <div class="col-md-4">
        <div class="card h-100" style="background-color: rgba(172, 216, 219, 0.9);">
            <div class="card-body text-center d-flex flex-column justify-content-center align-items-center">
                <h5 class="cash--subtitle">
                    Withdraw-Able balance
                </h5>
                <div class="d-flex align-items-center justify-content-center mt-3">
                    <div class="cash-icon mr-3">
                        <img src="https://6ammart-admin.6amtech.com/public/assets/admin/img/cash.png" alt="img">
                    </div>
                    <h4 class="cash--title">{{number_format($withdrawableBalance, 2) }}</h4>
                </div>
            </div>
            <div class="card-footer pt-0 bg-transparent border-0">
                <a class="btn text--title text-capitalize bg-white h--45px w-100" href="#!" data-bs-toggle="modal" data-bs-target="#withdrawModal">Request withdraw</a>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="row g-2">
            <div class="col-sm-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row flex-between-center g-0">
                            <div class="col-6 d-lg-block flex-between-center">
                                <h6 class="mb-2 text-warning"><b>Pending</b></h6>
                                <h5>{{  number_format($pendingWithdraw, 2) }}</h4>
                            </div>
                            <div class="col-auto h-100">
                                <div class="cash-icon mr-3">
                                    <img class="resturant-icon w--30" src="https://6ammart-admin.6amtech.com/public/assets/admin/img/transactions/pending.png" alt="transaction">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row flex-between-center g-0">
                            <div class="col-6 d-lg-block flex-between-center">
                                <h6 class="mb-2 text-success"><b>Withdrawn</b></h6>
                                <h5>{{  number_format($successWithdraw, 2) }}</h4>
                            </div>
                            <div class="col-auto h-100">
                                <div class="cash-icon mr-3">
                                    <img class="resturant-icon w--30" src="https://6ammart-admin.6amtech.com/public/assets/admin/img/transactions/withdraw-amount.png" alt="transaction">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row flex-between-center g-0">
                            <div class="col-6 d-lg-block flex-between-center">
                                <h6 class="mb-2 text-primary"><b>Total</b></h6>
                                <h5 >{{ number_format($totalBalance, 2) }}</h5>
                            </div>
                            <div class="col-auto h-100">
                                <div class="cash-icon mr-3">
                                    <img class="resturant-icon w--30" src="https://6ammart-admin.6amtech.com/public/assets/admin/img/transactions/withdraw-amount.png" alt="transaction">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row flex-between-center g-0">
                            <div class="col-6 d-lg-block flex-between-center">
                                <h6 class="mb-2 text-danger"><b>SAB</b></h6>
                                <h5 >{{ number_format($totalCommission, 2) }}</h5>
                            </div>
                            <div class="col-auto h-100">
                                <div class="cash-icon mr-3">
                                    <img class="resturant-icon w--30" src="https://6ammart-admin.6amtech.com/public/assets/admin/img/transactions/earning.png" alt="transaction">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="card my-4">
    <div class="card-header bg-light">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="mb-0" id="followers">Withdraw Request Table</h5>
            </div>
        </div>
        </div>
    <div class="card-body">
      <div class="table-responsive scrollbar">
        <table class="table data-table table-bordered table-striped fs--1 mb-0">
          <thead class="bg-200 text-900">
            <tr>
              <th>SN.</th>
              <th>Amount</th>
              {{-- <th>Account</th> --}}
              <th>Request Time</th>
              <th class="align-middle text-center">Status</th>
              <th class="align-middle text-center">Action</th>
            </tr>
          </thead>
          <tbody class="list">
            @foreach ($withdraws as $key => $withdraw)
            <tr>
                <td class="sn">{{ ++$key }}</td>
                <td class="name">{{number_format($withdraw->amount ,2)}}</td>
                {{-- <td class="name">{{$withdraw->bankInfo->number}}</td> --}}
                <td class="date">{{ date_format(date_create($withdraw->created_at), 'd M, Y') }}</td>
                <td class="align-middle text-center">
                    @if($withdraw->status == 'Pending')
                      <small class="badge fw-semi-bold rounded-pill badge-subtle-warning">PENDING</small>
                    @elseif($withdraw->status == 'Completed')
                      <small class="badge fw-semi-bold rounded-pill badge-subtle-success">COMPLETED</small>
                    @else
                      <small class="badge fw-semi-bold rounded-pill badge-subtle-danger">FAILED</small>
                    @endif
                </td>

                <td class="align-middle white-space-nowrap py-2 text-center">
                    @if ($withdraw->status == 'Pending' | $withdraw->status == 'Failed')
                        <div class="dropdown font-sans-serif position-static"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" id="customer-dropdown-0" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false"><svg class="svg-inline--fa fa-ellipsis-h fa-w-16 fs--1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis-h" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M328 256c0 39.8-32.2 72-72 72s-72-32.2-72-72 32.2-72 72-72 72 32.2 72 72zm104-72c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72zm-352 0c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72z"></path></svg><!-- <span class="fas fa-ellipsis-h fs--1"></span> Font Awesome fontawesome.com --></button>
                            <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-0">
                            <div class="py-2"><a class="dropdown-item text-danger" href="#!" >Delete</a></div>
                            </div>
                        </div>
                    @endif
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
</div>

<div class="modal fade" id="withdrawModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form action="{{ route('seller.withdraw') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate="novalidate">
            @csrf
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                        data-bs-dismiss="modal" aria-label="Close" onclick="event.preventDefault();"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                        <div class="col">
                            <h4 class="mb-0" id="followers">
                              <span class="page-header-icon">
                                <img src="https://6ammart-admin.6amtech.com/public/assets/admin/img/cash.png" width="20" alt="">
                              </span>
                                 Withdraw Request
                            </h4>
                        </div>
                    </div>
                    <div class="p-4 pb-0">
                        <div class="row">
                            
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="col-form-label" for="amount">Amount<span class="text-danger">*</span></label>
                                    <input class="form-control @error('amount') is-invalid @enderror" id="validationCustom03" type="number" value="{{ old('amount') }}" placeholder="Enter amount to withdraw" name="amount" required="" />
                                    @error('amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="payment">Payment Number <span class="text-danger">*</span> </label>
                                    <select class="form-select js-choice" required="required" data-options='{"removeItemButton":true,"placeholder":true}'
                                        id="payment" name="payment">
                                        <option value="">Select number...</option>
                                        @foreach ($bankInfos as $bankInfo)
                                            <option value="{{ $bankInfo->id }}" {{ old('payment') == $bankInfo->id ? 'selected' : '' }}>{{ $bankInfo->number }} ( {{ $bankInfo->name }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="col-form-label" for="code">Security Code<span class="text-danger">*</span></label>
                                    <input class="form-control @error('code') is-invalid @enderror" id="validationCustom03" name="code" placeholder="Enter security code from your phone" required="" />
                                    @error('amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-info" type="submit">Submit </button>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection