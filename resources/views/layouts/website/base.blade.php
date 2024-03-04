<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SAB Investments Co. LTD</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  @include('layouts.website.styles')
</head>

<body class="page-index">

  <!-- ======= Header ======= -->
  @include('layouts.website.header')
  <!-- End Header -->

 

  <main id="main">

    @yield('content')

  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    @include('layouts.website.footer')
  </footer>
  <!-- End Footer --><!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  {{-- <div id="preloader"></div> --}}

  <!-- Vendor JS Files -->
  @include('layouts.website.scripts')
 

</body>

</html>