<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<!-- /Added by HTTrack -->

<head>

    @include('layouts.common.styles')
    @include('layouts.common.bcard')
</head>

<body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <div class="container" data-layout="container">

            @include('layouts.staff.nav.orderman-navside')

            <div class="content">
                @include('layouts.staff.nav.navtop')
                @yield('content')

                @include('layouts.staff.footer')
            </div>
            @include('layouts.staff.modal')


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
