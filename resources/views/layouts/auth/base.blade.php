<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<!-- /Added by HTTrack -->

<head>
    
    @include('layouts.common.styles')
</head>

<body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <div class="container-fluid">
          <script>
            var isFluid = JSON.parse(localStorage.getItem('isFluid'));
            if (isFluid) {
              var container = document.querySelector('[data-layout]');
              container.classList.remove('container');
              container.classList.add('container-fluid');
            }
          </script>
           @yield('content')
          
        </div>
      </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

{{--    
    @include('layouts.common.offcanvas')
    @include('layouts.common.customize') --}}
    

    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    @include('layouts.common.scripts')
    
</body>

</html>