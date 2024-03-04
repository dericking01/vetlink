@extends('layouts.seller.base')

@section('content')

<div class="card">

    <div class="card-header bg-light">
      <div class="row align-items-center">
          <div class="col">
              <h5 class="mb-0" id="followers">Rejected Products
                {{-- <span class="d-none d-sm-inline-block">({{ $products->count() }})</span> --}}
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
                <th>Date</th>
                <th>ProductName</th>
                <th>ServiceCategory</th>
                <th>ProductCategory</th>
                <th>UnitPrice</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Info</th>
              </tr>
            </thead>
            <tbody class="list">
              @foreach ($products as $key => $product)
              <tr>
                <td class="sn">{{ ++$key }}</td>
                <td class="date">{{ date_format(date_create($product->created_at), 'd M, Y') }}</td>
                <td class="name">
                  <div class="d-flex align-items-center position-relative"><img class="rounded-1 border border-200" src="{{ asset('upload/catalog/'.$product->image) }}" width="60" alt="">
                      <div class="flex-1 ms-3">
                          <h6 class="mb-1 fw-semi-bold text-nowrap"><a class="text-900 stretched-link"
                                  href="{{ route('seller.products-details', $product->id) }}">{{ $product->name }}</a></h6>
                          <p class="fw-semi-bold mb-0 text-500">{{ strtok($product->description, ' ') }}....</p>
                      </div>
                  </div>
                </td>
                <td class="service_category">{{ $product->serviceCategory->CatName }}</td>
                <td class="service_category">{{ $product->productCategory->CatName }}</td>
                <td class="price">{{ number_format($product->price, 2) }}</td>
                <td class="quantity">{{ $product->quantity }}</td>

                @if ($product->isApproved == 'Approved')
                <td class="status">
                  <span class="badge badge-subtle-success">APPROVED</span>
                </td>
                @else
                <td class="status">
                  <span class="badge badge-subtle-danger">REJECTED</span>
                </td>
                @endif
                <td class="align-middle white-space-nowrap text-end">
                    <div class=" font-sans-serif position-static d-inline-block">
                        <a class="dropdown-item text-success" href="#!" data-bs-toggle="modal" data-bs-target="#deleteSender{{ $product->id }}">
                            <button class="btn btn-link text-600 btn-sm dropdown-toggle
                            btn-reveal float-end" type="button" id="dropdown-simple-pagination-table-item-1"
                            data-bs-toggle="dropdown" data-boundary="window"
                            aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                              <span class="fas fa-eye fs--1"></span>
                          </button>
                        </a>

                      </div>
                  </td>
              </tr>

              <div class="modal fade" id="deleteSender{{ $product->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
                    <div class="modal-content">
                        
                        <form action="" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="modal-icon text-center mb-3">
                                </div>
                                @if ($product->reason)
                                  <div class="modal-text text-center">
                                    <h3 class="text-danger"> {{$product->reason}} </h3>
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
