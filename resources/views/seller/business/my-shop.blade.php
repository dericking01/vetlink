@extends('layouts.seller.base')

@section('content')
<div class="row align-items-center mb-3">
    <div class="col">
        <h4 class="mb-0" id="followers">
            <span class="page-header-icon">
                <img class="w--26" src="https://6ammart-admin.6amtech.com/public/assets/admin/img/store.png" alt="public">
            </span>
             My Shop Info
        </h4>
    </div>
    <div class="col text-end">
        <a class="btn btn-falcon-default btn-sm" href="#!"><span class="d-none d-sm-inline-block me-1"><span class="fa fa-align-left text-primary"></span> Edit</span>my shop
        </a>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header position-relative min-vh-25 mb-7">
        <div class="bg-holder rounded-3 rounded-bottom-0" style="background-image:url({{ asset('/') }}assets/img/generic/4.jpg);"></div>
        <!--/.bg-holder-->
        <div class="avatar avatar-5xl avatar-profile">
            <img class="rounded-circle img-thumbnail shadow-sm" src="{{ asset('/') }}assets/img/team/2.jpg" width="200" alt="">
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-8">
            <h4 class="mb-1 text-uppercase"> {{ auth('seller')->user()->name }}<span data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Verified" data-bs-original-title="Verified"><svg class="svg-inline--fa fa-check-circle fa-w-16 text-primary" data-fa-transform="shrink-4 down-2" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="check-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="transform-origin: 0.5em 0.625em;"><g transform="translate(256 256)"><g transform="translate(0, 64)  scale(0.75, 0.75)  rotate(0 0 0)"><path fill="currentColor" d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z" transform="translate(-256 -256)"></path></g></g></svg><!-- <small class="fa fa-check-circle text-primary" data-fa-transform="shrink-4 down-2"></small> Font Awesome fontawesome.com --></span></h4>
            <h5 class="fs-0 fw-normal"><b>Phone:</b> +{{auth('seller')->user()->phone}}</h5>
            <h5 class="fs-0 fw-normal"><b>Email:</b> {{auth('seller')->user()->email}}</h5>
            <h5 class="fs-0 fw-normal"><b>Product(s):</b> Kuku wa nyama, mayai, kuku wa vifungashio</h5>
            <h5 class="fs-0 fw-normal"><b>Delivery Min:</b> 10 Units</h5>
            <h5 class="fs-0 fw-normal"><b>Quantity:</b> Over 5,000 units</h5>
            <h5 class="fs-0 fw-normal"><b>SAB Commission:</b> 5%</h5>
            <p class="text-500">{{ auth('seller')->user()->location }}</p>
            <div class="border-bottom border-dashed my-4 d-lg-none"></div>
            </div>
        </div>
    </div>
</div>

@endsection