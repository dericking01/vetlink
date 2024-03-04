@extends('layouts.admin.base')

@section('content')

<div class="card">
  <div class="card-header bg-light">
    <div class="row align-items-center">
        <div class="col">
            <h5 class="mb-0" id="followers">Users
              <span class="d-none d-sm-inline-block">({{ $users->count() }})</span>
                  </h5>
        </div>
        <div class="col text-end">
            <a class="font-sans-serif" href="#!" data-bs-toggle="modal" data-bs-target="#addproductcat">
                <button class="btn btn-falcon-default btn-sm" type="button"><svg class="svg-inline--fa fa-external-link-alt fa-w-16" data-fa-transform="shrink-3 down-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="external-link-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="transform-origin: 0.5em 0.625em;"><g transform="translate(256 256)"><g transform="translate(0, 64)  scale(0.8125, 0.8125)  rotate(0 0 0)"><path fill="currentColor" d="M432,320H400a16,16,0,0,0-16,16V448H64V128H208a16,16,0,0,0,16-16V80a16,16,0,0,0-16-16H48A48,48,0,0,0,0,112V464a48,48,0,0,0,48,48H400a48,48,0,0,0,48-48V336A16,16,0,0,0,432,320ZM488,0h-128c-21.37,0-32.05,25.91-17,41l35.73,35.73L135,320.37a24,24,0,0,0,0,34L157.67,377a24,24,0,0,0,34,0L435.28,133.32,471,169c15,15,41,4.5,41-17V24A24,24,0,0,0,488,0Z" transform="translate(-256 -256)"></path></g></g></svg><!-- <span class="fas fa-external-link-alt" data-fa-transform="shrink-3 down-2"></span> Font Awesome fontawesome.com -->
                    <span class="d-none d-sm-inline-block ms-1">Export</span>
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
              <th class="sort pe-1 align-middle white-space-nowrap">SN.</th>
              <th class="sort pe-1 align-middle white-space-nowrap" >Buyer Name</th>
              <th class="sort pe-1 align-middle white-space-nowrap">Joined at.</th>
              <th class="sort pe-1 align-middle white-space-nowrap text-center">Phone</th>
              <th class="sort pe-1 align-middle white-space-nowrap text-center">Status</th>
              <th class="sort pe-1 align-middle white-space-nowrap text-center">Role</th>
              <th class="align-middle no-sort text-center">Action</th>
            </tr>
          </thead>
          <tbody class="list">
            @foreach($users as $key => $user)
              <tr class="btn-reveal-trigger">
                <td class="sn">{{ ++$key }}</td>
                <td class="name align-middle white-space-nowrap py-2"><a href="{{ route('admin.view-user', $user->id) }}">
                  <div class="d-flex d-flex align-items-center">
                        <div class="avatar avatar-xl me-2">
                        <div class="avatar-name rounded-circle"><span>{{ \App\Helpers\SettingsHelper::getUserInitials($user->id) }}</span></div>
                        </div>
                        <div class="flex-1">
                        <h5 class="mb-0 fs--1">{{ $user->name }}</h5>
                        </div>
                    </div>
                  </a>
                </td>
                <td class="joined align-middle py-2">{{ date_format(date_create($user->created_at), 'd M, Y') }}</td>
                  <td class="phone align-middle white-space-nowrap py-2 text-center">
                      {{$user->phone}}
                  </td>
                  <td class="align-middle text-center">
                      <small class="badge fw-semi-bold rounded-pill badge-subtle-success">APPROVED</small>
                  </td>
                  <td class="align-middle text-center">
                        <small class="badge fw-semi-bold rounded-pill badge-subtle-primary">BUYER</small>
                  </td>
                  <td class="align-middle white-space-nowrap py-2 text-center">
                      <div class="dropdown font-sans-serif position-static"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" id="customer-dropdown-0" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false"><svg class="svg-inline--fa fa-ellipsis-h fa-w-16 fs--1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis-h" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M328 256c0 39.8-32.2 72-72 72s-72-32.2-72-72 32.2-72 72-72 72 32.2 72 72zm104-72c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72zm-352 0c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72z"></path></svg><!-- <span class="fas fa-ellipsis-h fs--1"></span> Font Awesome fontawesome.com --></button>
                      <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-0">
                          <div class="py-2"><a class="dropdown-item text-danger" href="#!" data-bs-toggle="modal" data-bs-target="#deleteBuyer{{ $user->id }}"  >Delete</a></div>
                      </div>
                      </div>
                  </td>
            </tr>

            {{-- delete Buyer --}}

            <div class="modal fade" id="deleteBuyer{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="{{ route('agent.destroybuyer') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                <div class="modal-icon text-center mb-3">
                                    <i class="fas fa-trash text-danger fa-3x"></i>
                                </div>
                                <div class="modal-text text-center">
                                    <h2 class="text-danger">Confirm Delete</h2>
                                    <p>Are you sure you want to delete?</p>
                                    <input type="hidden" name="id" value="{{ $user->id }}" />
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

            @endforeach
          </tbody>
        </table>
      </div>
    </div>
</div>

@endsection
