@extends('layouts.admin.base')

@section('content')


<div class="card">
  <div class="card-header bg-light">
    <div class="row align-items-center">
        <div class="col">
            <h5 class="mb-0" id="followers">Products
              <span class="d-none d-sm-inline-block">({{ $products->count() }})</span>
                  </h5>
        </div>
        <div class="col text-end">
            <a class="font-sans-serif" href="#!" data-bs-toggle="modal" data-bs-target="#addproduct">
                <button class="btn btn-falcon-default btn-sm" type="button">
                    <svg class="svg-inline--fa fa-plus fa-w-14" data-fa-transform="shrink-3 down-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="" style="transform-origin: 0.4375em 0.625em;"><g transform="translate(224 256)"><g transform="translate(0, 64)  scale(0.8125, 0.8125)  rotate(0 0 0)"><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" transform="translate(-224 -256)"></path></g></g></svg><!-- <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span> Font Awesome fontawesome.com -->
                        <span class="d-none d-sm-inline-block ms-1">Add Product</span>
                </button>
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
              <th>ProductName</th>
              <th>ServiceCategory</th>
              <th>ProductCategory</th>
              <th>UnitPrice</th>
              <th>Quantity</th>
              <th>Wholesale Qty</th>
              <th>Discount</th>
              <th>Seller</th>
              <th>Status</th>
              <th>Action</th>
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
                                href="{{ route('admin.sabproducts.details', $product->id) }}">{{ $product->name }}</a></h6>
                        <p class="fw-semi-bold mb-0 text-500">{{ strtok($product->description, ' ') }}....</p>
                    </div>
                </div>
              </td>
              <td class="service_category">{{ $product->serviceCategory->CatName }}</td>
              <td class="service_category">{{ $product->productCategory->CatName }}</td>
              <td class="price">{{ number_format($product->price, 2) }}</td>
              <td class="quantity">{{ $product->quantity }}</td>
              <td class="wholesale_minimum_qty">{{ $product->wholesale_minimum_qty }}</td>
              <td class="discount">{{ number_format($product->discount, 2) }}</td>
              <td class="status">
                <span class="badge badge-subtle-success">SAB</span>
              </td>
              @if ($product->status == true)
              <td class="status">
                <span class="badge badge-subtle-success">ACTIVE</span>
              </td>
              @else
              <td class="status">
                <span class="badge badge-subtle-danger">INACTIVE</span>
              </td>
              @endif
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
                      <a class="dropdown-item text-success" href="#!" data-bs-toggle="modal" data-bs-target="#editSender{{ $product->id }}">Edit</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item text-danger" href="#!" data-bs-toggle="modal" data-bs-target="#deleteSender{{ $product->id }}">Delete</a>
                    </div>
                  </div>
              </td>
            </tr>

            <div class="modal fade" id="deleteSender{{ $product->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="{{ route('admin.sabproducts.destroy') }}" method="POST">
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
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="editSender{{ $product->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <form action="{{ route('admin.sabproducts.update', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-content position-relative">
                            <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                                    data-bs-dismiss="modal" aria-label="Close" onclick="event.preventDefault();"></button>
                            </div>
                            <div class="modal-body p-0">
                                <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                                    <h4 class="mb-1" id="modalExampleDemoLabel">Edit product </h4>
                                </div>
                                <div class="p-4 pb-0">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="col-form-label" for="name">Product Name <span class="text-danger">*</span>
                                                </label>
                                                <input class="form-control @error('name') is-invalid @enderror" name="name"
                                                    id="name" type="text" placeholder="Name of the product" value="{{ $product->name }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="mb-3">
                                              <label class="col-form-label" for="quantity">Quantity <span class="text-danger">*</span>
                                              </label>
                                              <input class="form-control @error('quantity') is-invalid @enderror" name="quantity"
                                                  id="quantity" type="number" placeholder="Total product quantity" value="{{ $product->quantity }}" />
                                          </div>
                                         </div>
                                         <div class="col-md-6">
                                          <div class="mb-3">
                                              <label class="col-form-label" for="wholesale_minimum_qty">Wholesale Min Qty <span class="text-danger">*</span>
                                              </label>
                                              <input class="form-control @error('wholesale_minimum_qty') is-invalid @enderror" name="wholesale_minimum_qty"
                                                  id="wholesale_minimum_qty" type="number" placeholder="Wholesale minimum quantity" value="{{ $product->wholesale_minimum_qty }}" />
                                          </div>
                                         </div>
                                         <div class="col-md-6">
                                          <div class="mb-3">
                                              <label class="col-form-label" for="price">Price <span class="text-danger">*</span>
                                              </label>
                                              <input class="form-control @error('price') is-invalid @enderror" name="price"
                                                  id="price" type="number" placeholder="Price of the product" value="{{ $product->price }}" />
                                          </div>
                                         </div>
                                         <div class="col-md-6">
                                          <div class="mb-3">
                                              <label class="col-form-label" for="discount">Discount <span class="text-danger">*</span>
                                              </label>
                                              <input class="form-control @error('discount') is-invalid @enderror" name="discount"
                                                  id="discount" type="number" placeholder="Discount of the product for wholesale" value="{{ $product->discount }}" />
                                          </div>
                                         </div>
                                         <div class="col-md-6">
                                          <div class="mb-3">
                                              <label class="col-form-label" for="image">Image <span class="text-danger">*</span>
                                              </label>
                                              <input class="form-control" name="image"
                                                  id="image" type="file" />
                                          </div>
                                         </div>
                                         <div class="col-md-6">
                                          <div class="mb-3">
                                              <label for="status">Product Category <span class="text-danger">*</span> </label>
                                              <select class="form-control select2" id="status" name="product_category_id">
                                                @foreach ($productCategories as $productCategory)
                                                    <option value="{{ $productCategory->id }}" {{ (old('product_category_id', $product->product_category_id) == $productCategory->id) ? 'selected' : '' }}>
                                                        {{ $productCategory->CatName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="mb-3">
                                              <label for="status">Service Category <span class="text-danger">*</span> </label>
                                              <select class="form-control select2"
                                                  id="status" name="service_category_id">
                                                  @foreach ($serviceCategories as $serviceCategory)
                                                  <option value="{{ $serviceCategory->id }}" {{ (old('service_category_id', $product->service_category_id) == $serviceCategory->id) ? 'selected' : '' }}>{{ $serviceCategory->CatName }}</option>
                                                  @endforeach
                                              </select>
                                          </div>
                                      </div>
                                      <div class="col-md-12">
                                          <div class="mb-3">
                                              <label class="col-form-label" for="description">Description <span
                                                      class="text-danger">*</span>
                                              </label>
                                              <textarea name="description" id="description" cols="10" rows="5" class="form-control" maxlength="255">{{ $product->description }}</textarea>
                                          </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="status">Status <span class="text-danger">*</span> </label>
                                            <select class="form-select" id="organizerSingle2" size="1" name="status">
                                                <option value="1" {{ old('status', $product->status) == true ? 'selected' : '' }}>ACTIVE</option>
                                                <option value="0" {{ old('status', $product->status) == false ? 'selected' : '' }}>INACTIVE</option>
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
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
</div>

<div class="modal fade" id="addproduct" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <form action="{{ route('admin.sabproducts.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate="novalidate">
          @csrf
          <div class="modal-content position-relative">
              <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                  <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                      data-bs-dismiss="modal" aria-label="Close" onclick="event.preventDefault();"></button>
              </div>
              <div class="modal-body p-0">
                  <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                      <h4 class="mb-1" id="modalExampleDemoLabel">Add product </h4>
                  </div>
                  <div class="p-4 pb-0">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="mb-3">
                                  <label class="col-form-label" for="name">Product Name <span class="text-danger">*</span>
                                  </label>
                                  <input class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required=""
                                      id="name" type="text" placeholder="Name of the product" />
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                              </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3">
                                <label class="col-form-label" for="quantity">Quantity <span class="text-danger">*</span>
                                </label>
                                <input class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" required=""
                                    id="quantity" type="number" placeholder="Total product quantity" />
                                @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                           </div>
                           <div class="col-md-6">
                            <div class="mb-3">
                                <label class="col-form-label" for="wholesale_minimum_qty">Wholesale Min Qty <span class="text-danger">*</span>
                                </label>
                                <input class="form-control @error('wholesale_minimum_qty') is-invalid @enderror" name="wholesale_minimum_qty" value="{{ old('wholesale_minimum_qty') }}" required=""
                                    id="wholesale_minimum_qty" type="number" placeholder="Wholesale minimum quantity" />
                                @error('wholesale_minimum_qty')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                           </div>
                           <div class="col-md-6">
                            <div class="mb-3">
                                <label class="col-form-label" for="price">Price <span class="text-danger">*</span>
                                </label>
                                <input class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required=""
                                    id="price" type="number" placeholder="Price of the product" />
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                           </div>
                           <div class="col-md-6">
                            <div class="mb-3">
                                <label class="col-form-label" for="discount">Discount <span class="text-danger">*</span>
                                </label>
                                <input class="form-control @error('discount') is-invalid @enderror" name="discount" value="{{ old('discount') }}" required=""
                                    id="discount" type="number" placeholder="Discount of the product for wholesale" />
                                @error('discount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                           </div>
                           <div class="col-md-6">
                            <div class="mb-3">
                                <label class="col-form-label" for="image">Image <span class="text-danger">*</span>
                                </label>
                                <input class="form-control @error('image') is-invalid @enderror" name="image" required=""
                                    id="image" type="file" />
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                           </div>
                           <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status">Product Category <span class="text-danger">*</span> </label>
                                <select class="form-select js-choice" required="required" data-options='{"removeItemButton":true,"placeholder":true}'
                                    id="status" name="product_category_id">
                                    <option value="">Select category...</option>
                                    @foreach ($productCategories as $productCategory)
                                    <option value="{{ $productCategory->id }}" {{ old('product_category_id') == $productCategory->id ? 'selected' : '' }}>{{ $productCategory->CatName }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status">Service Category <span class="text-danger">*</span> </label>
                                <select class="form-select js-choice" required="required" data-options='{"removeItemButton":true,"placeholder":true}'
                                    id="status" name="service_category_id">
                                    <option value="">Select category...</option>
                                    @foreach ($serviceCategories as $serviceCategory)
                                    <option  value="{{ $serviceCategory->id }}" {{ old('service_category_id') == $serviceCategory->id ? 'selected' : '' }}>{{ $serviceCategory->CatName }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="col-form-label" for="description">Description <span
                                        class="text-danger">*</span>
                                </label>
                                <textarea name="description" id="description" cols="10" rows="5" class="form-control @error('description') is-invalid @enderror" required="" maxlength="255">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="status">Status <span class="text-danger">*</span> </label>
                                <select class="form-select js-choice" required="required" data-options='{"removeItemButton":true,"placeholder":true}'
                                id="status" name="status">

                                    <option value="">Select status...</option>
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Inactive</option>
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
