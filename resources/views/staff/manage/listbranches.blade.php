@extends('layouts.staff.base')

@section('content')
<div class="card">
  <div class="card-header bg-light">
    <div class="row align-items-center">
        <div class="col">
            <h5 class="mb-0" id="followers">Branches
              <span class="d-none d-sm-inline-block">({{ $branches->count() }})</span>
                  </h5>
        </div>
        <div class="col text-end">
            <a class="font-sans-serif" href="#!" data-bs-toggle="modal" data-bs-target="#addproductcat">
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
              <th class="sort pe-1 align-middle white-space-nowrap" data-sort="name">Branch Name</th>
              <th class="sort pe-1 align-middle white-space-nowrap text-center" data-sort="name">Location</th>
              <th class="sort pe-1 align-middle white-space-nowrap text-center" data-sort="name">Status</th>
            </tr>
          </thead>
          <tbody class="list">
            @foreach($branches as $key => $branch)
              <tr class="btn-reveal-trigger">
                <td class="sn">
                    {{ ++$key }}
                </td>
                <td class="name align-middle white-space-nowrap py-2">
                  {{-- <a href="javascript:void(0)"> --}}
                    <div class="d-flex d-flex align-items-center">
                      <div class="avatar avatar-xl me-2">
                        <div class="avatar-name rounded-circle"><span>{{ \App\Helpers\SettingsHelper::getBranchInitials($branch->id) }}</span></div>
                      </div>
                      <div class="flex-1">
                        <h5 class="mb-0 fs--1">{{ $branch->branch_name }}</h5>
                      </div>
                    </div>
                  {{-- </a> --}}
              </td>
                <td class="phone align-middle white-space-nowrap py-2 text-center">
                  {{ $branch->location }}
                </td>
                <td class="name align-middle white-space-nowrap py-2 text-center">
                  @if($branch->status == 'active')
                    <small class="badge fw-semi-bold rounded-pill badge-subtle-success">ACTIVE</small>
                  @else
                    <small class="badge fw-semi-bold rounded-pill badge-subtle-danger">INACTIVE</small>
                  @endif
                </td>
              </tr>

            @endforeach
          </tbody>
        </table>
      </div>
    </div>
</div>
@endsection
