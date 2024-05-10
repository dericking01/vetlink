@extends('layouts.admin.base')

@section('content')


<div class="card">
  <div class="card-header bg-light">
    <div class="row align-items-center">
        <div class="col">
            <h5 class="mb-0" id="followers">Staffs
              <span class="d-none d-sm-inline-block">({{ $staffs->count() }})</span>
                  </h5>
        </div>
        <div class="col text-end">
            <a class="font-sans-serif" href="#!" data-bs-toggle="modal" data-bs-target="#addproduct">
                <button class="btn btn-falcon-default btn-sm" type="button">
                    <svg class="svg-inline--fa fa-plus fa-w-14" data-fa-transform="shrink-3 down-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="" style="transform-origin: 0.4375em 0.625em;"><g transform="translate(224 256)"><g transform="translate(0, 64)  scale(0.8125, 0.8125)  rotate(0 0 0)"><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" transform="translate(-224 -256)"></path></g></g></svg><!-- <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span> Font Awesome fontawesome.com -->
                        <span class="d-none d-sm-inline-block ms-1">Add Staff</span>
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
              <th>Name</th>
              <th>Phone</th>
              <th>Added by</th>
              <th>location</th>
              <th>Last login at</th>
              <th>role</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody class="list">
            @foreach ($staffs as $key => $staff)
            <tr>
              <td class="sn">{{ ++$key }}</td>
              <td class="date">{{ date_format(date_create($staff->created_at), 'd M, Y') }}</td>
              <td class="name">
                <div class="d-flex d-flex align-items-center">
                    <div class="col-auto me-2">
                        <div class="avatar avatar-xl me-4">
                            <div class="avatar-name rounded-circle">
                                <span>{{ \App\Helpers\SettingsHelper::getStaffInitials($staff->id) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col" style="margin-left: -30px;">
                        {{$staff->name}}
                    </div>
                </div>
            </td>

              <td class="name">
                <div class="d-flex align-items-center position-relative">
                    {{-- <img class="rounded-1 border border-200" src="{{ asset('upload/catalog/'.$product->image) }}" width="60" alt=""> --}}
                    <div class="flex-1 ms-3">
                        <h6 class="mb-1 fw-semi-bold text-nowrap">
                            @php
                            $formattedPhone = str_replace('255', '0', $staff->phone);
                            @endphp
                        {{ $formattedPhone }}
                        </h6>
                    </div>
                </div>
              </td>
              <td class="name">
                <div class="d-flex align-items-center position-relative">
                    <div class="flex-1 ms-3">
                        <h6 class="mb-1 fw-semi-bold text-nowrap">{{ $staff->admin->name }}</h6>
                    </div>
                </div>
              </td>
              <td class="name">
                <div class="d-flex align-items-center position-relative">
                    <div class="flex-1 ms-3">
                        <h6 class="mb-1 fw-semi-bold text-nowrap">{{ $staff->location }}</h6>
                    </div>
                </div>
              </td>
              <td class="name">
                <div class="d-flex align-items-center position-relative">
                    <div class="flex-1 ms-3">
                        @if ($staff->last_login_at)
                            <h6 class="mb-1 fw-semi-bold rounded-pill badge-subtle-info">{{ $staff->last_login_at }}</h6>
                        @else
                            <small class="badge fw-semi-bold rounded-pill badge-subtle-dark">NOT YET</small>
                        @endif
                    </div>
                </div>
              </td>

              <td class="name">
                <div class="d-flex align-items-center position-relative">
                    <div class="flex-1 ms-3">
                        {{-- <h6 class="mb-1 fw-semi-bold text-nowrap">{{ $staff->role }}</h6> --}}
                  <small class="badge fw-semi-bold rounded-pill badge-subtle-primary">{{ Str::upper($staff->role) }}</small>

                    </div>
                </div>
              </td>
              {{-- <td class="align-middle text-center">
                <small class="badge fw-semi-bold rounded-pill badge-subtle-success">{{ Str::upper($admin->role) }}</small>
              </td> --}}
              @if ($staff->status == 'active')
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
                      <a class="dropdown-item text-success" href="#!" data-bs-toggle="modal" data-bs-target="#editSender{{ $staff->id }}">Edit</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item text-danger" href="#!" data-bs-toggle="modal" data-bs-target="#deleteSender{{ $staff->id }}">Delete</a>
                    </div>
                  </div>
              </td>
            </tr>

            <div class="modal fade" id="deleteSender{{ $staff->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="{{ route('admin.destroystaff') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                <div class="modal-icon text-center mb-3">
                                    <i class="fas fa-trash text-danger fa-3x"></i>
                                </div>
                                <div class="modal-text text-center">
                                    <h2 class="text-danger">Confirm Delete</h2>
                                    <p>Are you sure you want to delete?</p>
                                    <input type="hidden" name="id" value="{{ $staff->id }}" />
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

            <div class="modal fade" id="editSender{{ $staff->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <form action="{{ route('admin.updatestaff', ['id' => $staff->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-content position-relative">
                            <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                                    data-bs-dismiss="modal" aria-label="Close" onclick="event.preventDefault();"></button>
                            </div>
                            <div class="modal-body p-0">
                                <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                                    <h4 class="mb-1" id="modalExampleDemoLabel">Edit Staff </h4>
                                </div>
                                <div class="p-4 pb-0">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="col-form-label" for="name">Staff Name <span class="text-danger">*</span>
                                                </label>
                                                <input class="form-control @error('name') is-invalid @enderror" name="name"
                                                    id="name" type="text" placeholder="Name of the product" value="{{ $staff->name }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                              <label for="validationCustom04" class="form-label">Phone Number</label>
                                              <input class="form-control @error('phone') is-invalid @enderror" id="validationCustom04" value="{{ old('phone', $staff->phone) }}" type="phone" name="phone" autocomplete="on" placeholder="Phone number"/>
                                              @error('phone')
                                                  <div class="invalid-feedback">{{ $message }}</div>
                                              @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                          <div class="mb-3">
                                            <label for="validationCustom05" class="form-label">Email Address</label>
                                            <input class="form-control @error('email') is-invalid @enderror" id="validationCustom05" value="{{ old('email', $staff->email) }}" type="text" name="email" autocomplete="on" placeholder="Email address"/>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                          </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="col-form-label" for="name">Location<span class="text-danger">*</span>
                                                </label>
                                                <input class="form-control @error('name') is-invalid @enderror" name="location"
                                                    id="name" type="text" placeholder="location" value="{{ $staff->location }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="status">Status <span class="text-danger">*</span></label>
                                                <select class="form-select" id="status" name="status">
                                                    <option value="active" {{ old('status', $staff->status) == 'active' ? 'selected' : '' }}>ACTIVE</option>
                                                    <option value="inactive" {{ old('status', $staff->status) == 'inactive' ? 'selected' : '' }}>INACTIVE</option>
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
        <form action="{{ route('admin.storestaff') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate="novalidate">
            @csrf
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                        data-bs-dismiss="modal" aria-label="Close" onclick="event.preventDefault();"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1" id="modalExampleDemoLabel">Add Staff </h4>
                    </div>
                    <div class="p-4 pb-0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="col-form-label" for="name">Staff Name <span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required=""
                                        id="name" type="text" placeholder="Name of Staff" />
                                      @error('name')
                                          <div class="invalid-feedback">{{ $message }}</div>
                                      @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="col-form-label" for="name">Email <span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control @error('name') is-invalid @enderror" name="email" value="{{ old('name') }}" required=""
                                        id="name" type="text" placeholder="staff's Email" />
                                      @error('name')
                                          <div class="invalid-feedback">{{ $message }}</div>
                                      @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                  <label for="validationCustom04" class="form-label">Phone Number</label>
                                  <input class="form-control @error('phone') is-invalid @enderror" id="validationCustom04" value="{{ old('phone', $staff->phone) }}" type="phone" name="phone" autocomplete="on" placeholder="Phone number"/>
                                  @error('phone')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="col-form-label" for="name">Location <span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control @error('name') is-invalid @enderror" name="location" value="{{ old('name') }}" required=""
                                        id="name" type="text" placeholder="Name of Staff" />
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
@endsection
