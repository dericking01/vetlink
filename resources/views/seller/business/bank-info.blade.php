@extends('layouts.seller.base')

@section('content')
<div class="row align-items-center mb-3">
    <div class="col">
        <h4 class="mb-0" id="followers">
          <span class="page-header-icon">
            <img src="https://6ammart-admin.6amtech.com/public/assets/admin/img/bank.png" width="35" alt="">
          </span>
             My Bank Info
             @if ($bankInfos->count() > 0)
              <span class="badge rounded-pill badge-subtle-info"><span>{{ $bankInfos->count() }}</span></span>
            @else
              <span class="badge rounded-pill badge-subtle-danger"><span>{{ $bankInfos->count() }}</span></span>
             @endif
        </h4>
    </div>
    <div class="col text-end">
        <a class="btn btn-falcon-default btn-sm" href="#!" data-bs-toggle="modal" data-bs-target="#addbankinfo">
          <span class="d-none d-sm-inline-block me-1">
            <span class="fa fa-plus text-primary">
              </span> Add</span>bank info
        </a>
    </div>
</div>

<div class="row g-3 mb-3">
  @forelse ($bankInfos as $key => $bankInfo)
    <div class="col-md-4">
      <div class="card">
        <div class="card-header bg-light d-flex flex-between-center py-2">
          <h6 class="mb-0">Payment Method</h6>
          <div class="dropdown font-sans-serif position-static d-inline-block btn-reveal-trigger">
            <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal dropdown-caret-none" type="button" id="dropdown-payment-methods" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
              <svg class="svg-inline--fa fa-ellipsis-h fa-w-16 fs--1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis-h" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M328 256c0 39.8-32.2 72-72 72s-72-32.2-72-72 32.2-72 72-72 72 32.2 72 72zm104-72c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72zm-352 0c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72z"></path></svg><!-- <span class="fas fa-ellipsis-h fs--1"></span> Font Awesome fontawesome.com -->
            </button>
            <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown-payment-methods">
              <a class="dropdown-item" href="#!">Edit</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item text-danger" href="#!">Delete</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row g-3 h-100">
            <div class="col-sm-6 col-lg-12">
              <div class="card position-relative rounded-4">
                <div class="bg-holder bg-card rounded-4" style="
                    background-image: url(../../assets/img/icons/spot-illustrations/corner-2.png);
                  "></div>
                <!--/.bg-holder-->
                <div class="card-body p-3 pt-5 pt-xxl-4">

                  @if ($bankInfo->issuer)
                    @switch($bankInfo->issuer)
                        @case('M-PESA')
                            <img class="mb-3" src="../../assets/img/icons/vodacom.png" alt="" width="30">
                            <img class="mb-3" src="../../assets/img/icons/chip.png" alt="" width="30">
                            @break

                        @case('HaloPesa')
                            <img class="mb-3" src="../../assets/img/icons/halotel.png" alt="" width="30">
                            <img class="mb-3" src="../../assets/img/icons/chip.png" alt="" width="30">
                            @break

                        @case('AirtelMoney')
                            <img class="mb-3" src="../../assets/img/icons/airtel.png" alt="" width="30">
                            <img class="mb-3" src="../../assets/img/icons/chip.png" alt="" width="30">
                            @break

                        @case('TigoPesa')
                            <img class="mb-3" src="../../assets/img/icons/tigo.png" alt="" width="30">
                            <img class="mb-3" src="../../assets/img/icons/chip.png" alt="" width="30">
                            @break

                        @case('NMB')
                            <img class="mb-3" src="../../assets/img/icons/nmb.png" alt="" width="30">
                            <img class="mb-3" src="../../assets/img/icons/chip.png" alt="" width="30">
                            @break

                        @case('Equity')
                            <img class="mb-3" src="../../assets/img/icons/equity.png" alt="" width="30">
                            <img class="mb-3" src="../../assets/img/icons/chip.png" alt="" width="30">
                            @break

                        @case('NBC')
                            <img class="mb-3" src="../../assets/img/icons/nbc.png" alt="" width="30">
                            <img class="mb-3" src="../../assets/img/icons/chip.png" alt="" width="30">
                            @break

                        @case('CRDB')
                            <img class="mb-3" src="../../assets/img/icons/crdb.png" alt="" width="30">
                            <img class="mb-3" src="../../assets/img/icons/chip.png" alt="" width="30">
                            @break

                        @default
                            <!-- Default case if none of the above conditions are met -->
                    @endswitch
                  @endif


                  <h6 class="text-primary font-base lh-1 mb-1">{{ $bankInfo->number }}</h6>
                  <h6 class="fs--2 fw-semi-bold text-facebook mb-3">{{ $bankInfo->issuer }}</h6>
                  <h6 class="mb-0 text-facebook">{{ $bankInfo->name }}</h6>
                  <img class="position-absolute end-0 bottom-0 mb-2 me-2" src="../../assets/img/icons/master-card.png" alt="" width="70">
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-12">
              <table class="table table-borderless fw-medium font-sans-serif fs--1 mb-2">
                <tbody>
                  <tr>
                    <td class="p-1" style="width: 35%">Type:</td>
                    <td class="p-1 text-600">{{ $bankInfo->type }}</td>
                  </tr>
                  <tr>
                    <td class="p-1" style="width: 35%">Name:</td>
                    <td class="p-1 text-600">{{ $bankInfo->name }}</td>
                  </tr>
                  <tr>
                    <td class="p-1" style="width: 35%">Expires:</td>
                    <td class="p-1 text-600"> {{ $bankInfo->expires }}</td>
                  </tr>
                  <tr>
                    <td class="p-1" style="width: 35%">Issuer:</td>
                    <td class="p-1 text-600">{{ $bankInfo->issuer }}</td>
                  </tr>
                </tbody>
              </table>
              @if ($bankInfo->status == 'Non-Billable')
                <span class="badge rounded-pill badge-subtle-warning">Non Billable <i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
              @else
                <span class="badge rounded-pill badge-subtle-success">Billable <i class="fa fa-check-circle" aria-hidden="true"></i></span>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  @empty
    <div class="card col-6">
      <div class="card-header bg-light d-flex flex-between-center py-2">
        <h6 class="mb-0">No Payment Method(s) Found!</h6>
        <div class="dropdown font-sans-serif position-static d-inline-block btn-reveal-trigger">
          <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal dropdown-caret-none" type="button" id="dropdown-payment-methods" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
            <svg class="svg-inline--fa fa-ellipsis-h fa-w-16 fs--1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis-h" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M328 256c0 39.8-32.2 72-72 72s-72-32.2-72-72 32.2-72 72-72 72 32.2 72 72zm104-72c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72zm-352 0c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72z"></path></svg><!-- <span class="fas fa-ellipsis-h fs--1"></span> Font Awesome fontawesome.com -->
          </button>
          <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown-payment-methods">
            <a class="dropdown-item" href="#!">Edit</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-danger" href="#!">Delete</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row g-3 h-100">
          <div class="col-sm-6 col-lg-12">
            <div class="card position-relative rounded-4">
              <div class="bg-holder bg-card rounded-4" style="
                  background-image: url(../../assets/img/icons/spot-illustrations/corner-2.png);
                "></div>
              <!--/.bg-holder-->
              <div class="card-body p-3 pt-5 pt-xxl-4">
                <img class="mb-3" src="../../assets/img/icons/chip.png" alt="" width="30">
                <h6 class="text-primary font-base lh-1 mb-1">**** **** **** ****</h6>
                <h6 class="fs--2 fw-semi-bold text-facebook mb-3">**/**</h6>
                <h6 class="mb-0 text-facebook">No Data Found</h6>
                <img class="position-absolute end-0 bottom-0 mb-2 me-2" src="../../assets/img/icons/master-card.png" alt="" width="70">
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-12">
            <table class="table table-borderless fw-medium font-sans-serif fs--1 mb-2">
              <tbody>
                <tr>
                  <td class="p-1" style="width: 35%">Type:</td>
                  <td class="p-1 text-600"></td>
                </tr>
                <tr>
                  <td class="p-1" style="width: 35%">Name:</td>
                  <td class="p-1 text-600"></td>
                </tr>
                <tr>
                  <td class="p-1" style="width: 35%">Expires:</td>
                  <td class="p-1 text-600"> </td>
                </tr>
                <tr>
                  <td class="p-1" style="width: 35%">Issuer:</td>
                  <td class="p-1 text-600"></td>
                </tr>
                <tr>
                  <td class="p-1" style="width: 35%">ID:</td>
                  <td class="p-1 text-600"></td>
                </tr>
              </tbody>
            </table>
            <span class="badge rounded-pill badge-subtle-warning"><span>Non Billable</span><svg class="svg-inline--fa fa-exclamation-triangle fa-w-18 ms-1" data-fa-transform="shrink-4" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="exclamation-triangle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg="" style="transform-origin: 0.5625em 0.5em;"><g transform="translate(288 256)"><g transform="translate(0, 0)  scale(0.75, 0.75)  rotate(0 0 0)"><path fill="currentColor" d="M569.517 440.013C587.975 472.007 564.806 512 527.94 512H48.054c-36.937 0-59.999-40.055-41.577-71.987L246.423 23.985c18.467-32.009 64.72-31.951 83.154 0l239.94 416.028zM288 354c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z" transform="translate(-288 -256)"></path></g></g></svg><!-- <span class="fas fa-exclamation-triangle ms-1" data-fa-transform="shrink-4"></span> Font Awesome fontawesome.com --></span>
          </div>
        </div>
      </div>
    </div>
  @endforelse
</div>

  <div class="modal fade" id="addbankinfo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form action="{{ route('seller.store-bank-info') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate="novalidate">
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
                            <img src="https://6ammart-admin.6amtech.com/public/assets/admin/img/bank.png" width="35" alt="">
                          </span>
                             Add Bank Info
                        </h4>
                    </div>
                    </div>
                    <div class="p-4 pb-0">
                        <div class="row">
                          
                          <div class="col-md-6">
                            <div class="mb-3">
                                <label class="col-form-label" for="paymentType">Payment Type<span class="text-danger">*</span></label>
                                <select class="form-select" name="paymentType" id="paymentType" required="required">
                                    <option value="">Select payment type...</option>
                                    <option value="Bank" >Bank</option>
                                    <option value="Mobile">Mobile Money</option>
                                </select>
                            </div>
                        </div>
                    
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="col-form-label" for="issuer">Issuer Name <span class="text-danger">*</span></label>
                                <select class="form-select" name="issuer" id="issuer" required="required">
                                    <option value="">Select issuer name...</option>
                                </select>
                            </div>
                        </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="col-form-label" for="expires">Expires Date<span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control @error('expires') is-invalid @enderror" id="validationCustom03" type="text" value="{{ old('expires') }}" name="expires" placeholder="Example: 05/25" required="" />
                                    @error('expires')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                              <div class="mb-3">
                                  <label class="col-form-label" for="name">Holders' Name<span class="text-danger">*</span>
                                  </label>
                                  <input class="form-control @error('name') is-invalid @enderror" id="validationCustom03" type="text" value="{{ old('name') }}" name="name" placeholder="Enter holders' name" required="" />
                                  @error('name')
                                  <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                              </div>
                            </div>

                          <div class="col-md-12">
                            <div class="mb-3">
                                <label class="col-form-label" for="number">Holders' Number<span class="text-danger">*</span>
                                </label>
                                <input class="form-control @error('number') is-invalid @enderror" id="validationCustom03" type="number" value="{{ old('number') }}" name="number" placeholder="Enter holders' number" required="" />
                                @error('number')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
  
                            <div class="col-md-12">
                              <div class="mb-3">
                                  <label for="status">Status <span class="text-danger">*</span> </label>
                                  <select class="form-select js-choice" id="organizerSingle2" size="1" required="required" name="status" data-options='{"removeItemButton":true,"placeholder":true}'>
                                    <option value="">Select status...</option>
                                    <option value="Billable" {{ old('status') == 'Billable' ? 'selected' : '' }}>Billable</option>
                                    <option value="Non-Billable" {{ old('status') == 'Non-Billable' ? 'selected' : '' }}>Non-Billable</option>
                                  </select>
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