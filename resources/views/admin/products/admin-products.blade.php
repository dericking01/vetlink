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
            <a class="font-sans-serif" href="#!" data-bs-toggle="modal" data-bs-target="#addBULKproduct">
                <button class="btn btn-falcon-default btn-sm" type="button">
                    <svg class="bi bi-box-arrow-down" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 01.707 0l3 3a.5.5 0 01-.707.707L8.5 3.707V9a.5.5 0 01-1 0V3.707L4.646 5.354a.5.5 0 01-.707-.707l3-3zM1 5.5a.5.5 0 01.5-.5h3a.5.5 0 010 1H2.707L5.354 8.646a.5.5 0 11-.708.708L1.146 6.354A.5.5 0 011 5.646zM2 14a.5.5 0 01.5-.5h11a.5.5 0 010 1H2.5a.5.5 0 01-.5-.5z"/>
                    </svg>
                    <span class="d-none d-sm-inline-block ms-1">Bulk Import</span>
                </button>
            </a>
            <a class="font-sans-serif" href="#!" data-bs-toggle="modal" data-bs-target="#addproduct">
                <button class="btn btn-falcon-default btn-sm" type="button">
                    <svg class="svg-inline--fa fa-plus fa-w-14" data-fa-transform="shrink-3 down-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="" style="transform-origin: 0.4375em 0.625em;"><g transform="translate(224 256)"><g transform="translate(0, 64)  scale(0.8125, 0.8125)  rotate(0 0 0)"><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" transform="translate(-224 -256)"></path></g></g></svg><!-- <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span> Font Awesome fontawesome.com -->
                        <span class="d-none d-sm-inline-block ms-1">Add Product</span>
                </button>
            </a>
            <a class="font-sans-serif" href="{{ route('admin.products.export') }}">
                <button class="btn btn-falcon-default btn-sm" type="button"><svg class="svg-inline--fa fa-external-link-alt fa-w-16" data-fa-transform="shrink-3 down-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="external-link-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="transform-origin: 0.5em 0.625em;"><g transform="translate(256 256)"><g transform="translate(0, 64)  scale(0.8125, 0.8125)  rotate(0 0 0)"><path fill="currentColor" d="M432,320H400a16,16,0,0,0-16,16V448H64V128H208a16,16,0,0,0,16-16V80a16,16,0,0,0-16-16H48A48,48,0,0,0,0,112V464a48,48,0,0,0,48,48H400a48,48,0,0,0,48-48V336A16,16,0,0,0,432,320ZM488,0h-128c-21.37,0-32.05,25.91-17,41l35.73,35.73L135,320.37a24,24,0,0,0,0,34L157.67,377a24,24,0,0,0,34,0L435.28,133.32,471,169c15,15,41,4.5,41-17V24A24,24,0,0,0,488,0Z" transform="translate(-256 -256)"></path></g></g></svg><!-- <span class="fas fa-external-link-alt" data-fa-transform="shrink-3 down-2"></span> Font Awesome fontawesome.com -->
                    <span class="d-none d-sm-inline-block ms-1">Export</span>
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
              {{-- <th>Added by</th> --}}
              <th>Branch Name</th>
              <th>Product Name</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Status</th>
              {{-- <th>Description</th> --}}
              <th>Action</th>
            </tr>
          </thead>
          <tbody class="list">
            @foreach ($products as $key => $product)
            <tr>
              <td class="sn">{{ ++$key }}</td>
              <td class="date">{{ date_format(date_create($product->created_at), 'd M, Y') }}</td>
              {{-- <td class="name">
                {{$product->admin->name}}
              </td> --}}
              <td class="name" style="text-align: center;">
                @if($product->branch && $product->branch->branch_name)
                    {{ $product->branch->branch_name }}
                @else
                    <span class="badge badge-subtle-warning">NONE</span>
                @endif
              </td>

              <td class="name">
                <div class="d-flex align-items-center position-relative">
                    {{-- <img class="rounded-1 border border-200" src="{{ asset('upload/catalog/'.$product->image) }}" width="60" alt=""> --}}
                    <div class="flex-1 ms-3">
                        <h6 class="mb-1 fw-semi-bold text-nowrap">{{ $product->name }}</h6>
                    </div>
                </div>
              </td>
              <td class="name">
                <div class="d-flex align-items-center position-relative">
                    <div class="flex-1 ms-3">
                        <h6 class="mb-1 fw-semi-bold text-nowrap">{{ $product->price }}</h6>
                    </div>
                </div>
              </td>
              <td class="name">
                <div class="d-flex align-items-center position-relative">
                    <div class="flex-1 ms-3">
                        <h6 class="mb-1 fw-semi-bold text-nowrap">{{ $product->quantity }}</h6>
                    </div>
                </div>
              </td>
              @if ($product->status == 'active')
              <td class="status">
                <span class="badge badge-subtle-success">AVAILABLE</span>
              </td>
              @else
              <td class="status">
                <span class="badge badge-subtle-danger">NOT AVAILABLE</span>
              </td>
              @endif
              {{-- <td class="name">
                <div class="d-flex align-items-center position-relative">
                    <div class="flex-1 ms-3">
                        <h6 class="mb-1 fw-semi-bold text-nowrap">{{ $product->description ?? 'none'}}</h6>
                    </div>
                </div>
              </td> --}}

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

                        <form action="{{ route('admin.products.destroy') }}" method="POST">
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
                    <form action="{{ route('admin.products.update', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
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
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="col-form-label" for="name">Product Name <span class="text-danger">*</span>
                                                </label>
                                                <input class="form-control @error('name') is-invalid @enderror" name="name"
                                                    id="name" type="text" placeholder="Name of the product" value="{{ $product->name }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="col-form-label" for="quantity">Quantity <span class="text-danger">*</span>
                                                </label>
                                                <input class="form-control @error('quantity') is-invalid @enderror" name="quantity"
                                                    id="quantity" type="number" placeholder="Total product quantity" value="{{ $product->quantity }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="col-form-label" for="units">Units <span class="text-danger">*</span>
                                                </label>
                                                <input class="form-control @error('units') is-invalid @enderror" name="units"
                                                    id="units" type="text" placeholder="Total product units" value="{{ $product->units }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="col-form-label" for="expire_date">Expire date <span class="text-danger">*</span>
                                                </label>
                                                <input class="form-control @error('expire_date') is-invalid @enderror" name="expire_date"
                                                    id="expire_date" type="text" placeholder="Total product expire_date" value="{{ $product->expire_date }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="col-form-label" for="price">Price <span class="text-danger">*</span>
                                                </label>
                                                <input class="form-control @error('price') is-invalid @enderror" name="price"
                                                    id="price" type="number" placeholder="Price of the product" value="{{ $product->price }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="branch">Branch Name</label>
                                            <select class="form-control select2" id="branch{{ $product->id }}" name="branch">
                                                <option value="">Select branch...</option>
                                                @foreach ($branches as $branch)
                                                    <option value="{{ $branch->id }}" {{ old('branch', $product->branch_id) == $branch->id ? 'selected' : '' }}>
                                                        {{ $branch->branch_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="col-form-label" for="image">Image <span class="text-danger">*</span>
                                                </label>
                                                <input class="form-control" name="image"
                                                    id="image" type="file" />
                                            </div>
                                        </div> --}}

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
                                                <label for="status">Status <span class="text-danger">*</span></label>
                                                <select class="form-select" id="status" name="status">
                                                    <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>AVAILABLE</option>
                                                    <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>NOT AVAILABLE</option>
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
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate="novalidate">
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
                            <div class="col-md-12">
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
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="col-form-label" for="name">Quantity <span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control @error('name') is-invalid @enderror" name="quantity" value="{{ old('name') }}" required=""
                                        id="name" type="text" placeholder="Quantity of the product" />
                                      @error('name')
                                          <div class="invalid-feedback">{{ $message }}</div>
                                      @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="col-form-label" for="name">Units <span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control @error('name') is-invalid @enderror" name="units" value="{{ old('name') }}" required=""
                                        id="name" type="text" placeholder="Units of the product" />
                                      @error('name')
                                          <div class="invalid-feedback">{{ $message }}</div>
                                      @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="col-form-label" for="name">Expire date <span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control @error('name') is-invalid @enderror" name="expire_date" value="{{ old('name') }}" required=""
                                        id="name" type="text" placeholder="Expire date of the product" />
                                      @error('name')
                                          <div class="invalid-feedback">{{ $message }}</div>
                                      @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="col-form-label" for="name">Price <span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control @error('name') is-invalid @enderror" name="price" value="{{ old('name') }}" required=""
                                        id="name" type="number" placeholder="Price of the product" />
                                      @error('name')
                                          <div class="invalid-feedback">{{ $message }}</div>
                                      @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label" for="name">Branch Name <span class="text-danger">*</span>
                                </label>
                                <select class="form-select js-choice" id="organizerSingle2" size="1" required="required" name="branch" data-options='{"removeItemButton":true,"placeholder":true}'>
                                    <option value="">Select branch...</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>{{ $branch->branch_name }}</option>
                                    @endforeach
                                </select>
                                  @error('name')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                            </div>

                            {{-- <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="col-form-label" for="image">Image <span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control @error('image') is-invalid @enderror" name="image" required=""
                                        id="image" type="file" />
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> --}}

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="col-form-label" for="name">Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('name') is-invalid @enderror" name="description" required="" id="name" placeholder="Description of the product">{{ old('name') }}</textarea>
                                    @error('name')
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


<div class="modal fade" id="addBULKproduct" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form action="{{ route('admin.products.import') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate="novalidate">
            @csrf
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                        data-bs-dismiss="modal" aria-label="Close" onclick="event.preventDefault();"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1" id="modalExampleDemoLabel">Upload an Excel File (max 2MB) </h4>
                    </div>
                    <a href="{{ asset('upload/catalog/upload-sample.xlsx') }}" class="btn btn-link">&nbsp;&nbsp;&nbsp;&nbsp;Download a Sample Format ?</a>

                    <div class="p-4 pb-0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="col-form-label" for="file">&nbsp;&nbsp;Upload File <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" required id="file" accept=".csv,.xlsx" onchange="validateFileSize()">
                                    @error('file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="invalid-feedback" id="file-size-error" style="display:none;">File size must be less than 2MB.</div>
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

<script>
    function validateFileSize() {
        const fileInput = document.getElementById('file');
        const fileSizeError = document.getElementById('file-size-error');
        const maxSize = 2 * 1024 * 1024; // 2MB in bytes

        if (fileInput.files[0].size > maxSize) {
            fileInput.classList.add('is-invalid');
            fileSizeError.style.display = 'block';
        } else {
            fileInput.classList.remove('is-invalid');
            fileSizeError.style.display = 'none';
        }
    }
</script>

