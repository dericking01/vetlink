@extends('layouts.admin.base')

@section('content')
<div class="container mt-4">
    <!-- Custom Styles -->
    <style>
        .badge-custom-success {
            background-color: #28a745; /* Bootstrap success color */
            color: white;
        }
        .badge-custom-danger {
            background-color: #dc3545; /* Bootstrap danger color */
            color: white;
        }
    </style>

    <!-- Branch Details -->
    <div class="card shadow-sm p-3 mb-4 bg-white rounded">
        <h2 class="text-center text-primary">{{ $branch->branch_name }}</h2>
        <p class="text-muted text-center"><strong>Location:</strong> {{ $branch->location }}</p>
        <p class="text-muted text-center"><strong>Status:</strong>
            <span class="badge {{ $branch->status === 'active' ? 'badge-custom-success' : 'badge-custom-danger' }}">
                {{ $branch->status === 'active' ? 'ACTIVE' : 'INACTIVE' }}
            </span>
        </p>
    </div>

    <!-- View Stock Button -->
    <div class="text-center mb-3">
        <a href="{{ route('admin.branch.stock', ['id' => $branch->id]) }}" class="btn btn-primary">
            View Stock
        </a>
    </div>

    <!-- Product Distribution Table -->
    <div class="card shadow-sm p-3 mb-4 bg-light rounded">
        <h4 class="text-dark text-center">Product Distributions for this Branch:</h4>
        <div class="table-responsive">
            <table class="table data-table table-bordered table-striped table-hover fs--1 mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Distribution Date</th>
                        <th>Product Name</th>
                        <th>Quantity Distributed</th>
                        <th>Units</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th class="align-middle no-sort text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($branch->branchProducts as $distribution)
                        <tr>
                            <td>{{ $distribution->created_at->format('F j, Y, g:i a') }}</td>
                            <td>{{ $distribution->adminProduct->name }}</td>
                            <td>{{ $distribution->quantity }}</td>
                            <td>{{ $distribution->adminProduct->units }}</td>
                            <td>{{ number_format($distribution->price, 2) }}</td>
                            <td>
                                @if ($distribution->adminProduct->description)
                                    {{ $distribution->adminProduct->description }}
                                @else
                                    <span class="badge badge-subtle-primary">NONE</span>
                                @endif
                            </td>
                            <td class="align-middle white-space-nowrap py-2 text-center">
                                <div class="dropdown font-sans-serif position-static">
                                    <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" id="customer-dropdown-0" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                        <svg class="svg-inline--fa fa-ellipsis-h fa-w-16 fs--1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis-h" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor" d="M328 256c0 39.8-32.2 72-72 72s-72-32.2-72-72 32.2-72 72-72 72 32.2 72 72zm104-72c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72zm-352 0c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72z"></path>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-0">
                                        <div class="py-2"><a class="dropdown-item text-success" href="#!" data-bs-toggle="modal" data-bs-target="#editAgent{{ $distribution->id }}">Edit</a></div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        {{-- Edit modal here --}}
                        <div class="modal fade" id="editAgent{{ $distribution->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <form action="{{ route('branchproduct.update', ['id' => $distribution->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div>
                                        <div class="modal-content position-relative">
                                            <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                                                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close" onclick="event.preventDefault();"></button>
                                            </div>
                                            <div class="modal-body p-0">
                                                <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                                                    <h4 class="mb-1" id="modalExampleDemoLabel">Edit Product Price</h4>
                                                </div>

                                                <div class="p-4 pb-0">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Product Name</label>
                                                                <input class="form-control @error('name') is-invalid @enderror" id="validationCustom03" value="{{ old('name', $distribution->adminProduct->name) }}" name="name" type="text" autocomplete="on" placeholder="Full Name" readonly/>
                                                                @error('name')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Quantity</label>
                                                                <input class="form-control @error('location') is-invalid @enderror" id="validationCustom03" value="{{ old('name', $distribution->quantity) }}" name="location" type="text" autocomplete="on" placeholder="Location" readonly/>
                                                                @error('location')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Price</label>
                                                                <input class="form-control @error('email') is-invalid @enderror" id="validationCustom05" value="{{ old('name', $distribution->price) }}" type="text" name="price" autocomplete="on" placeholder="Customer's email"/>
                                                                @error('email')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Close</button>
                                                <button class="btn btn-info" type="submit">Submit</button>
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
@endsection
