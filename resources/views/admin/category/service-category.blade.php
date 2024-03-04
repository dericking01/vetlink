@extends('layouts.admin.base')

@section('content')


<div class="card">
  <div class="card-header bg-light">
    <div class="row align-items-center">
        <div class="col">
            <h5 class="mb-0" id="followers">Service Categories
              <span class="d-none d-sm-inline-block">({{ $service_Categories->count() }})</span>
                  </h5>
        </div>
        <div class="col text-end">
            <a class="font-sans-serif" href="#!" data-bs-toggle="modal" data-bs-target="#addservicecat">
                <button class="btn btn-falcon-default btn-sm" type="button">
                    <svg class="svg-inline--fa fa-plus fa-w-14" data-fa-transform="shrink-3 down-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="" style="transform-origin: 0.4375em 0.625em;"><g transform="translate(224 256)"><g transform="translate(0, 64)  scale(0.8125, 0.8125)  rotate(0 0 0)"><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" transform="translate(-224 -256)"></path></g></g></svg><!-- <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span> Font Awesome fontawesome.com -->
                        <span class="d-none d-sm-inline-block ms-1">Add Category</span>
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
                <th class="sort pe-1 align-middle white-space-nowrap" data-sort="phone">Category no.</th>
              <th class="sort pe-1 align-middle white-space-nowrap text-center" data-sort="name">Category Name</th>
              <th class="sort pe-1 align-middle white-space-nowrap text-center" data-sort="name">Description</th>
              <th class="sort pe-1 align-middle white-space-nowrap text-center" data-sort="name">Status</th>
              <th class="align-middle no-sort text-center">Action</th>
            </tr>
          </thead>
          <tbody class="list">
            @foreach($service_Categories as $key => $servCat)
              <tr class="btn-reveal-trigger">
                  <td class="joined align-middle py-2">SAB {{$servCat->CatID}}</td>
                  <td class="name align-middle white-space-nowrap py-2"><a href="#">
                      <div class="d-flex d-flex align-items-center">
                          <div class="avatar avatar-xl me-2">

                          </div>
                          <div class="flex-1">
                          <h5 class="mb-0 fs--1">{{$servCat->CatName}}</h5>
                          </div>
                      </div>
                      </a>
                  </td>
                  <td class="phone align-middle white-space-nowrap py-2 text-center">
                      @if($servCat->Description)
                          {{$servCat->Description}}
                      @else
                          ----
                      @endif

                  </td>
                  <td class="align-middle text-center">
                      @if($servCat->status == 'Active')
                          <small class="badge fw-semi-bold rounded-pill badge-subtle-success">ACTIVE</small>
                      @else
                          <small class="badge fw-semi-bold rounded-pill badge-subtle-warning">INACTIVE</small>
                      @endif
                  <td class="align-middle white-space-nowrap py-2 text-center">
                      <div class="dropdown font-sans-serif position-static"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" id="customer-dropdown-0" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false"><svg class="svg-inline--fa fa-ellipsis-h fa-w-16 fs--1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis-h" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M328 256c0 39.8-32.2 72-72 72s-72-32.2-72-72 32.2-72 72-72 72 32.2 72 72zm104-72c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72zm-352 0c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72z"></path></svg><!-- <span class="fas fa-ellipsis-h fs--1"></span> Font Awesome fontawesome.com --></button>
                      <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-0">
                          <div class="py-2"><a class="dropdown-item text-success" href="#" data-bs-toggle="modal" data-bs-target="#editSender{{ $servCat->id }}">Edit</a><a class="dropdown-item text-danger" href="#!" data-bs-toggle="modal" data-bs-target="#deleteService{{ $servCat->id }}" >Delete</a></div>
                      </div>
                      </div>
                  </td>
              </tr>

              <div class="modal fade" id="deleteService{{ $servCat->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="{{ route('admin.destroyservice') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                <div class="modal-icon text-center mb-3">
                                    <i class="fas fa-trash text-danger fa-3x"></i>
                                </div>
                                <div class="modal-text text-center">
                                    <h2 class="text-danger">Confirm Delete</h2>
                                    <p>Are you sure you want to delete?</p>
                                    <input type="hidden" name="id" value="{{ $servCat->id }}" />
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

              <div class="modal fade" id="editSender{{ $servCat->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <form action="{{ route('admin.update-service', ['id' => $servCat->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div>
                          <div class="modal-content position-relative">
                            <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                                    data-bs-dismiss="modal" aria-label="Close" onclick="event.preventDefault();"></button>
                            </div>
                            <div class="modal-body p-0">
                                <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                                    <h4 class="mb-1" id="modalExampleDemoLabel">Edit Product Category </h4>
                                </div>

                                <div class="p-4 pb-0">
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="mb-3">
                                              <label class="col-form-label" for="catName">Service Category Name <span class="text-danger">*</span>
                                              </label>
                                              <input class="form-control @error('catName') is-invalid @enderror" type="text" name="catName" value="{{ old('catName', $servCat->CatName) }}" placeholder="Service Category Name" />
                                              @error('catName')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                              @enderror
                                          </div>
                                      </div>

                                      <div class="col-md-12">
                                        <div class="mb-3">
                                          <label for="catStatus" class="form-label">Service Category Status</label>
                                          <select class="form-control" name="status">
                                            <option value="Active" @if($servCat->status == 'Active') selected @endif>Active</option>
                                            <option value="Inactive" @if($servCat->status == 'Inactive') selected @endif>Inactive</option>
                                            {{-- <option value="Active" {{ old('status', $servCat->status) === 'Active' ? 'selected' : '' }}>Active</option>
                                            <option value="Inactive" {{ old('status', $servCat->status) === 'Inactive' ? 'selected' : '' }}>Inactive</option> --}}
                                          </select>
                                        </div>
                                      </div>

                                      <div class="col-md-12">
                                          <div class="mb-3">
                                              <label class="col-form-label" for="description">Description </label>
                                              <textarea class="form-control" type="text" name="description" placeholder="Service Category Description (Optional)" rows="3">{{ old('description', $servCat->Description) }}</textarea>
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

<div class="modal fade" id="addservicecat" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <form action="{{ route('admin.storeServCat') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate="novalidate">
          @csrf
          <div class="modal-content position-relative">
              <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                  <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                      data-bs-dismiss="modal" aria-label="Close" onclick="event.preventDefault();"></button>
              </div>
              <div class="modal-body p-0">
                  <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                      <h4 class="mb-1" id="modalExampleDemoLabel">Add Service Category </h4>
                  </div>
                  <div class="p-4 pb-0">
                      <div class="row">
                          <div class="col-md-12">
                              <div class="mb-3">
                                  <label class="col-form-label" for="catName">Service Category Name <span class="text-danger">*</span>
                                  </label>
                                  <input class="form-control @error('catName') is-invalid @enderror" id="validationCustom03" type="text" value="{{ old('catName') }}" name="catName" placeholder="Service Category Name" required="" />
                                  @error('catName')
                                  <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                              </div>
                          </div>

                          <div class="col-md-12">
                            <div class="mb-3">
                                <label for="status">Service Category Status <span class="text-danger">*</span> </label>
                                <select class="form-select js-choice" id="organizerSingle2" size="1" required="required" name="status" data-options='{"removeItemButton":true,"placeholder":true}'>
                                  <option value="">Select status...</option>
                                  <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                                  <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>

                          <div class="col-md-12">
                              <div class="mb-3">
                                  <label class="col-form-label" for="description">Description </label>
                                  <textarea class="form-control" id="validationCustom03" type="text" value="{{ old('description') }}" placeholder="Service Category Description" name="description" rows="3" >{{ old('description') }}</textarea>
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
