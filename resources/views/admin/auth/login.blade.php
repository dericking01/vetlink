@extends('layouts.auth.base')

@section('content')
<div class="row min-vh-100 bg-100">
    <div class="col-6 d-none d-lg-block position-relative">
      <div class="bg-holder" style="background-image:url(../../../assets/img/generic/dodokiHome.png);background-position: 50% 20%;"></div>
      <!--/.bg-holder-->
    </div>
    <div class="col-sm-10 col-md-6 px-sm-0 align-self-center mx-auto py-5">
      <div class="row justify-content-center g-0">
        <div class="col-lg-9 col-xl-8 col-xxl-6">
          <div class="card">
            <div class="card-header bg-circle-shape bg-shape text-center p-2"><a class="font-sans-serif fw-bolder fs-4 z-1 position-relative link-light" href="#!" data-bs-theme="light">DODOKI - PORTAL</a></div>
            <div class="card-body p-4">
              <div class="row flex-between-center">
                <div class="col-auto">
                  <h3>Login</h3>
                </div>
                <div class="col-auto fs--1 text-600">
                    <span class="mb-0 fw-semi-bold">Not an Admin?</span>
                    <span><a href="{{ route('staff.login') }} ">Go Here</a></span>
                </div>
              </div>
              <form action="{{ route('admin.submit.login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="split-login-email">Email <span class="text-danger">*</span> </label>
                    <input type="email" name="email" class="form-control" id="split-login-email" placeholder="youremail@gmail.com" autofocus />
                </div>
                <div class="mb-3">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="split-login-password">Password <span class="text-danger">*</span> </label>
                  </div>
                  <input type="password" name="password" class="form-control" id="split-login-password" placeholder="8+ characters" />
                </div>
                <div class="row flex-between-center">
                  <div class="col-auto">
                    <div class="form-check mb-0">
                        <input class="form-check-input" type="checkbox" id="split-checkbox" />
                        <label class="form-check-label mb-0" for="split-checkbox">Remember me</label>
                    </div>
                  </div>
                  <div class="col-auto">
                    <a class="fs--1" href="{{ route('forgotpassword') }}">Forgot Password?</a>
                  </div>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">Log in</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
