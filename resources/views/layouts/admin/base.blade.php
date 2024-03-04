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
        <div class="container" data-layout="container">
            
            @include('layouts.admin.nav.navside')

            <div class="content">
                @include('layouts.admin.nav.navtop')
                @yield('content')
                
                @include('layouts.admin.footer')
            </div>
            @include('layouts.admin.modal')

            
        </div>
    </main><!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

   
    @include('layouts.common.offcanvas')
    {{-- @include('layouts.common.customize') --}}
    

    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    @include('layouts.common.scripts')
    
</body>

</html>