@extends('layouts.admin.base')

@section('content')

<head>
    <!-- other head elements -->

    <style>
        .custom-modal-width {
            max-width: 60%; /* Adjust the percentage according to your needs */
        }
    </style>
</head>


<div class="card my-4">
    <div class="card-header bg-light">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="mb-0" id="followers">Settled Transactions
                    <span class="d-none d-sm-inline-block">({{ $withdraws->count() }})</span>
                </h5>
            </div>
        </div>
        </div>
    <div class="card-body">
      <div class="table-responsive scrollbar">
        <table class="table data-table table-bordered table-striped fs--1 mb-0">
          <thead class="bg-200 text-900">
            <tr>
              <th>SN.</th>
              <th>Seller's Name</th>
              <th>Amount</th>
              <th>Method</th>
              <th>Request Time</th>
              <th class="align-middle text-center">Status</th>
              <th class="align-middle text-center">Action</th>
            </tr>
          </thead>
          <tbody class="list">
            @foreach ($withdraws as $key => $withdraw)
            <tr>
                <td class="sn">{{ ++$key }}</td>
                <td class="sn">{{ $withdraw->seller->name }}</td>
                <td class="name">{{number_format($withdraw->amount ,2)}}</td>
                <td class="name"> {{ $withdraw->bankInfo->issuer }} </td>
                <td class="date">{{ date_format(date_create($withdraw->created_at), 'd M, Y H:i') }}</td>
                <td class="align-middle text-center">
                    @if($withdraw->status == 'Completed')
                      <small class="badge fw-semi-bold rounded-pill badge-subtle-success">COMPLETED</small>
                    @else
                      <small class="badge fw-semi-bold rounded-pill badge-subtle-danger">FAILED</small>
                    @endif
                </td>

                <td class="align-middle white-space-nowrap py-2 text-center">
                    @if ($withdraw->status == 'Failed')
                        <div class=" font-sans-serif position-static d-inline-block">
                            <a class="dropdown-item text-success" href="#!" data-bs-toggle="modal" data-bs-target="#reason{{ $withdraw->id }}">
                                <button class="btn btn-link text-600 btn-sm dropdown-toggle
                                btn-reveal float-end" type="button" id="dropdown-simple-pagination-table-item-1"
                                data-bs-toggle="dropdown" data-boundary="window"
                                aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                <span class="fas fa-eye fs--1"></span>
                            </button>
                            </a>
                        </div>
                    @else
                        <div class="dropdown font-sans-serif position-static">
                            <a class="font-sans-serif" href="#!" data-bs-toggle="modal" data-bs-target="#reject{{ $withdraw->id }}">

                                <button class="btn btn-danger btn-sm " type="button">
                                    <span class="d-none d-sm-inline-block ms-1" style="text-decoration: none; color: rgb(214, 154, 154);">Reject</span>
                                </button>
                            </a>
                        </div>
                    @endif
                </td>
            </tr>

            <div class="modal fade" id="reject{{ $withdraw->id }}" tabindex="-1" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog custom-modal-width modal-dialog-centered" role="document">
                    <form action="{{ route('admin.settledTrans.reject', ['id' => $withdraw->id]) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-content position-relative">
                            <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">

                            </div>
                            <div class="modal-body p-0">

                                <div class="p-4 pb-0">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="mb-3 text-center">

                                                <textarea name="description" id="description" cols="10" placeholder="Kindly, Provide a reason for rejecting this withdrawal request" rows="5" class="form-control @error('description') is-invalid @enderror"  maxlength="255">{{ old('description', $withdraw->reason) }}</textarea>
                                                @error('description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" type="button"
                                    data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-info" type="submit">Submit </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- <div class="modal fade" id="reject{{ $withdraw->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <form action="{{ route('admin.settledTrans.reject', ['id' => $withdraw->id]) }}" method="POST">

                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="modal-icon text-center mb-3">
                                    <i class="fas fa-sad-tear text-danger fa-3x"></i>
                                </div>
                                <div class="modal-text text-center">
                                    <h2 class="text-danger">Reject Request</h2>
                                    <p>Are you sure you want to Reject ?</p>
                                    <input type="hidden" name="id" value="{{ $withdraw->id }}" />
                                </div>
                            </div>
                            <div class="modal-footer text-center">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> --}}

            <div class="modal fade" id="reason{{ $withdraw->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
                    <div class="modal-content">

                        <form action="" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="modal-icon text-center mb-3">
                                </div>
                                @if ($withdraw->reason)
                                  <div class="modal-text text-center">
                                    <h3 class="text-danger"> {{$withdraw->reason}} </h3>
                                  </div>
                                @else
                                  <div class="modal-text text-center">
                                    <h3 class="text-danger"> No reason provided </h3>
                                  </div>
                                @endif
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
