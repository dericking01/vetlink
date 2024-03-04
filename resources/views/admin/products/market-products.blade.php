@extends('layouts.admin.base')

@section('content')
    <div class="card">
        <div class="card-header bg-light">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0" id="followers">Seller Posts
                        <span class="d-none d-sm-inline-block">({{ $market_products->count() }})</span>
                    </h5>
                </div>
                <div class="col text-end">
                    <a class="font-sans-serif" href="#!" data-bs-toggle="modal" data-bs-target="#addproductcat">
                        <button class="btn btn-falcon-default btn-sm" type="button"><svg
                                class="svg-inline--fa fa-external-link-alt fa-w-16" data-fa-transform="shrink-3 down-2"
                                aria-hidden="true" focusable="false" data-prefix="fas" data-icon="external-link-alt"
                                role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""
                                style="transform-origin: 0.5em 0.625em;">
                                <g transform="translate(256 256)">
                                    <g transform="translate(0, 64)  scale(0.8125, 0.8125)  rotate(0 0 0)">
                                        <path fill="currentColor"
                                            d="M432,320H400a16,16,0,0,0-16,16V448H64V128H208a16,16,0,0,0,16-16V80a16,16,0,0,0-16-16H48A48,48,0,0,0,0,112V464a48,48,0,0,0,48,48H400a48,48,0,0,0,48-48V336A16,16,0,0,0,432,320ZM488,0h-128c-21.37,0-32.05,25.91-17,41l35.73,35.73L135,320.37a24,24,0,0,0,0,34L157.67,377a24,24,0,0,0,34,0L435.28,133.32,471,169c15,15,41,4.5,41-17V24A24,24,0,0,0,488,0Z"
                                            transform="translate(-256 -256)"></path>
                                    </g>
                                </g>
                            </svg><!-- <span class="fas fa-external-link-alt" data-fa-transform="shrink-3 down-2"></span> Font Awesome fontawesome.com -->
                            <span class="d-none d-sm-inline-block ms-1">Export Form</span>
                        </button>
                    </a>
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
                            <th>Seller</th>
                            <th>UnitPrice</th>
                            <th>Quantity</th>
                            <th>Wholesale Min Qty</th>
                            <th>Wholesale Price</th>
                            <th>Purchased Qty</th>
                            <th>Status</th>
                            <th>isApproved</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($market_products as $key => $product)
                            <tr>
                                <td class="sn">{{ ++$key }}</td>
                                <td class="date">{{ date_format(date_create($product->created_at), 'd M, Y') }}</td>
                                <td class="name">
                                    <div class="d-flex align-items-center position-relative"><img
                                            class="rounded-1 border border-200"
                                            src="{{ asset('upload/catalog/' . $product->image) }}" width="60"
                                            alt="">
                                        <div class="flex-1 ms-3">
                                            <h6 class="mb-1 fw-semi-bold text-nowrap"><a class="text-900 stretched-link"
                                                    href="{{ route('admin.marketproducts.details', $product->id) }}">{{ $product->name }}</a></h6>
                                            <p class="fw-semi-bold mb-0 text-500">{{ strtok($product->description, ' ') }}....</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="service_category">{{ $product->serviceCategory->CatName }}</td>
                                <td class="product_category">{{ $product->productCategory->CatName }}</td>
                                <td class="seller">{{ $product->seller->name }}</td>
                                <td class="price">{{ number_format($product->price, 2) }}</td>
                                <td class="quantity">{{ $product->quantity }}</td>
                                <td class="wholesale_minimum_qty">{{ $product->wholesale_minimum_qty }}</td>
                                <td class="discount">{{ number_format($product->discount, 2) }}</td>
                                <td class="purchased_qty">{{ $product->purchasedQty }}</td>
                                @if ($product->status == 'Available')
                                    <td class="status">
                                        <span class="badge badge-subtle-success">{{ Str::upper($product->status) }}</span>
                                    </td>
                                @else
                                    <td class="status">
                                        <span class="badge badge-subtle-danger">{{ Str::upper($product->status) }}</span>
                                    </td>
                                @endif
                                @if ($product->isApproved == 'Approved')
                                    <td class="is_approved">
                                        <span class="badge badge-subtle-success">APPROVED</span>
                                    </td>
                                @else
                                    <td class="status">
                                        <span class="badge badge-subtle-danger">REJECTED</span>
                                    </td>
                                @endif
                                <td class="align-middle white-space-nowrap text-end">
                                    <div class="dropstart font-sans-serif position-static d-inline-block">
                                        <button
                                            class="btn btn-link text-600 btn-sm dropdown-toggle
                                                btn-reveal float-end"
                                            type="button" id="dropdown-simple-pagination-table-item-1"
                                            data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true"
                                            aria-expanded="false" data-bs-reference="parent">
                                            <span class="fas fa-ellipsis-h fs--1"></span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end border py-2"
                                            aria-labelledby="dropdown-simple-pagination-table-item-1">
                                            <a class="dropdown-item text-success" href="#!" data-bs-toggle="modal"
                                                data-bs-target="#editSender{{ $product->id }}">Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#!" data-bs-toggle="modal"
                                                data-bs-target="#deleteSender{{ $product->id }}">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="deleteSender{{ $product->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <form action="{{ route('admin.marketproducts.destroy') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body">
                                                <div class="modal-icon text-center mb-3">
                                                    <i class="fas fa-trash text-danger fa-3x"></i>
                                                </div>
                                                <div class="modal-text text-center">
                                                    <h2 class="text-danger">Confirm Delete</h2>
                                                    <p>Are you sure you want to delete?</p>
                                                    <input type="hidden" name="id" value="{{ $product->id }}" />
                                                </div>
                                            </div>
                                            <div class="modal-footer text-center">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="editSender{{ $product->id }}" tabindex="-1" role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <form action="{{ route('admin.marketproducts.update', ['id' => $product->id]) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content position-relative">
                                            <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                                                <button
                                                    class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                                                    data-bs-dismiss="modal" aria-label="Close"
                                                    onclick="event.preventDefault();"></button>
                                            </div>
                                            <div class="modal-body p-0">
                                                <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                                                    <h4 class="mb-1" id="modalExampleDemoLabel">Edit product </h4>
                                                </div>
                                                <div class="p-4 pb-0">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="status">Seller Name </label>
                                                                <input class="form-control type="text" value="{{ $product->seller->name }}" readonly/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="col-form-label" for="name">Product Name</label>
                                                                <input class="form-control type="text" value="{{ $product->name }}" readonly/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="col-form-label" for="quantity">Quantity </label>
                                                                <input class="form-control type="text" value="{{ $product->quantity }}" readonly/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="col-form-label"
                                                                    for="wholesale_minimum_qty">Wholesale Min Qty</label>
                                                                    <input class="form-control type="text" value="{{ $product->wholesale_minimum_qty }}" readonly/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="col-form-label" for="price">Price</label>
                                                                <input class="form-control type="text" value="{{ $product->price }}" readonly/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="col-form-label" for="discount">Discount</label>
                                                                <input class="form-control type="text" value="{{ $product->discount }}" readonly/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="status">Status <span class="text-danger">*</span> </label>
                                                                <select class="form-select" id="organizerSingle2" size="1" name="status">
                                                                    <option value="Available" {{ old('status', $product->status) == 'Available' ? 'selected' : '' }}>Available</option>
                                                                    <option value="SoldOut" {{ old('status', $product->status) == 'SoldOut' ? 'selected' : '' }}>Sold Out</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="status">Approval <span class="text-danger">*</span> </label>
                                                                <select class="form-select" id="organizerSingle2" size="1" name="isApproved">
                                                                    <option value="Approved" {{ old('status', $product->isApproved) == 'Approved' ? 'selected' : '' }}>Approve</option>
                                                                    <option value="Rejected" {{ old('status', $product->isApproved) == 'Rejected' ? 'selected' : '' }}>Reject</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label class="col-form-label" for="description">Reason for Rejection <span
                                                                        class="text-danger">*</span>
                                                                </label>
                                                                <textarea name="description" id="description" cols="10" rows="5" class="form-control @error('description') is-invalid @enderror"  maxlength="255">{{ old('description', $product->reason) }}</textarea>
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
