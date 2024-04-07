@extends('layouts.admin.base')

@section('content')

<div class="card">
  <div class="card-header bg-light">
    <div class="row align-items-center">
        <div class="col">
            <h5 class="mb-0" id="followers">Staffs
              <span class="d-none d-sm-inline-block">({{ $admins->count() }})</span>
                  </h5>
        </div>
        <div class="col text-end">
          <a href="#" data-bs-toggle="modal" data-bs-target="#addstaff">
            <button class="btn btn-falcon-default btn-sm" type="button">
                <svg class="svg-inline--fa fa-plus fa-w-14" data-fa-transform="shrink-3 down-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="" style="transform-origin: 0.4375em 0.625em;"><g transform="translate(224 256)"><g transform="translate(0, 64)  scale(0.8125, 0.8125)  rotate(0 0 0)"><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" transform="translate(-224 -256)"></path></g></g></svg><!-- <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span> Font Awesome fontawesome.com -->
                    <span class="d-none d-sm-inline-block ms-1">New Staff</span>
            </button>
          </a>
            {{-- <a class="font-sans-serif" href="#!" data-bs-toggle="modal" data-bs-target="#addproductcat">
                <button class="btn btn-falcon-default btn-sm" type="button"><svg class="svg-inline--fa fa-external-link-alt fa-w-16" data-fa-transform="shrink-3 down-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="external-link-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="transform-origin: 0.5em 0.625em;"><g transform="translate(256 256)"><g transform="translate(0, 64)  scale(0.8125, 0.8125)  rotate(0 0 0)"><path fill="currentColor" d="M432,320H400a16,16,0,0,0-16,16V448H64V128H208a16,16,0,0,0,16-16V80a16,16,0,0,0-16-16H48A48,48,0,0,0,0,112V464a48,48,0,0,0,48,48H400a48,48,0,0,0,48-48V336A16,16,0,0,0,432,320ZM488,0h-128c-21.37,0-32.05,25.91-17,41l35.73,35.73L135,320.37a24,24,0,0,0,0,34L157.67,377a24,24,0,0,0,34,0L435.28,133.32,471,169c15,15,41,4.5,41-17V24A24,24,0,0,0,488,0Z" transform="translate(-256 -256)"></path></g></g></svg><!-- <span class="fas fa-external-link-alt" data-fa-transform="shrink-3 down-2"></span> Font Awesome fontawesome.com -->
                    <span class="d-none d-sm-inline-block ms-1">Export</span>
                </button>
            </a> --}}
        </div>
    </div>
    </div>
    <div class="card-body">
      <div class="table-responsive scrollbar">
        <table class="table data-table table-bordered table-striped fs--1 mb-0">
          <thead class="bg-200 text-900">
            <tr>
              <th class="sort pe-1 align-middle white-space-nowrap" data-sort="phone">Joined</th>
              <th class="sort pe-1 align-middle white-space-nowrap text-center" data-sort="name">Staff Name</th>
              <th class="sort pe-1 align-middle white-space-nowrap" data-sort="name">Phone</th>
              <th class="sort pe-1 align-middle white-space-nowrap" data-sort="email">Email</th>
              <th class="sort pe-1 align-middle white-space-nowrap text-center" data-sort="phone">Role</th>
              <th class="align-middle no-sort text-center">Action</th>
          </tr>
          </thead>
          <tbody class="list">
            @foreach($admins as $key => $admin)
            <tr class="btn-reveal-trigger">
              <td class="joined align-middle py-2">{{ date_format(date_create($admin->created_at), 'd M, Y') }}</td>
              <td class="name align-middle white-space-nowrap py-2"><a href="#">
                  <div class="d-flex d-flex align-items-center">
                      <div class="avatar avatar-xl me-2">
                      <div class="avatar-name rounded-circle"><span>{{ \App\Helpers\SettingsHelper::getAdminInitials($admin->id) }}</span></div>
                      </div>
                      <div class="flex-1">
                      <h5 class="mb-0 fs--1">{{ $admin->name }}</h5>
                      </div>
                  </div>
                  </a>
              </td>
              <td class="phone align-middle white-space-nowrap py-2"><a href="tel:2012001851">{{ $admin->phone }}</a></td>
              <td class="email align-middle py-2"><a href="mailto:ricky@example.com">{{ $admin->email }}</a></td>
              <td class="align-middle text-center">
                  <small class="badge fw-semi-bold rounded-pill badge-subtle-success">{{ Str::upper($admin->role) }}</small>
              </td>
              <td class="align-middle white-space-nowrap py-2 text-center">
                  <div class="dropdown font-sans-serif position-static"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" id="customer-dropdown-0" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false"><svg class="svg-inline--fa fa-ellipsis-h fa-w-16 fs--1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis-h" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M328 256c0 39.8-32.2 72-72 72s-72-32.2-72-72 32.2-72 72-72 72 32.2 72 72zm104-72c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72zm-352 0c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72z"></path></svg><!-- <span class="fas fa-ellipsis-h fs--1"></span> Font Awesome fontawesome.com --></button>
                  <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-0">
                      <div class="py-2"><a class="dropdown-item text-success" href="#" data-bs-toggle="modal" data-bs-target="#editAdmin{{ $admin->id }}">Edit</a><a class="dropdown-item text-danger" href="#!" data-bs-toggle="modal" data-bs-target="#deleteStaff{{ $admin->id }}">Delete</a></div>
                  </div>
                  </div>
              </td>
          </tr>

          <div class="modal fade" id="deleteStaff{{ $admin->id }}" tabindex="-1" aria-hidden="true">
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
                                <input type="hidden" name="id" value="{{ $admin->id }}" />
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

          {{-- editModal here... --}}

          <div class="modal fade" id="editAdmin{{ $admin->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <form action="{{ route('admin.update', ['id' => $admin->id]) }}" method="POST" enctype="multipart/form-data">
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
                                <h4 class="mb-1" id="modalExampleDemoLabel">Edit Staff </h4>
                            </div>

                            <div class="p-4 pb-0">
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="mb-3">
                                        <label for="validationCustom03" class="form-label">Full Name</label>
                                        <input class="form-control @error('name') is-invalid @enderror" id="validationCustom03" value="{{ old('name', $admin->name) }}" name="name" type="text" autocomplete="on" placeholder="Full Name"/>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                      </div>
                                  </div>

                                  <div class="col-md-12">
                                    <div class="mb-3">
                                      <label for="validationCustom04" class="form-label">Phone Number</label>
                                      <input class="form-control @error('phone') is-invalid @enderror" id="validationCustom04" value="{{ old('phone', $admin->phone) }}" type="phone" name="phone" autocomplete="on" placeholder="Phone number"/>
                                      @error('phone')
                                          <div class="invalid-feedback">{{ $message }}</div>
                                      @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                  <div class="mb-3">
                                    <label for="validationCustom05" class="form-label">Email Address</label>
                                    <input class="form-control @error('email') is-invalid @enderror" id="validationCustom05" value="{{ old('email', $admin->email) }}" type="text" name="email" autocomplete="on" placeholder="Email address"/>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                  </div>
                              </div>

                                  {{-- <div class="col-md-12">
                                    <div class="mb-3">
                                      <label for="validationCustom03" class="form-label">Role</label>
                                      <select class="form-select" id="organizerSingle2" size="1" name="role">
                                        <option value="admin" {{ old('role', $admin->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                                      </select>
                                    </div>
                                    </div> --}}

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

<div class="modal fade" id="addstaff" tabindex="-1" role="dialog" aria-hidden="true">
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
                                <label for="validationCustom03" class="form-label">Full Name</label>
                                <input class="form-control @error('name') is-invalid @enderror" id="validationCustom03" value="{{ old('name') }}" name="name" type="text" autocomplete="on" placeholder="Full Name" required />
                                @error('name')
                                  <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                              </div>
                          </div>

                          <div class="col-md-12">
                            <div class="mb-3">
                              <label for="validationCustom04" class="form-label">Phone Number</label>
                              <input class="form-control @error('phone') is-invalid @enderror" id="validationCustom04" value="{{ old('phone') }}" type="phone" name="phone" autocomplete="on" placeholder="Phone number" required />
                              @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                          <div class="mb-3">
                            <label for="validationCustom05" class="form-label">Email Address</label>
                            <input class="form-control @error('email') is-invalid @enderror" id="validationCustom05" value="{{ old('email') }}" type="text" name="email" autocomplete="on" placeholder="Email address" required />
                            @error('email')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>

                          {{-- <div class="col-md-12">
                            <div class="mb-3">
                              <label for="validationCustom06" class="form-label">Select Role</label>
                              <select class="form-select js-choice @error('role') is-invalid @enderror" id="organizerSingle2" size="1" required="required" name="role" aria-label="Default select example" data-options='{"removeItemButton":true,"placeholder":true}'>
                                <option value="">Select status...</option>
                                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                              </select>
                              @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                            </div>
                        </div> --}}

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
