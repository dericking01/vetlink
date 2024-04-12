<script>
    var isFluid = JSON.parse(localStorage.getItem('isFluid'));
    if (isFluid) {
        var container = document.querySelector('[data-layout]');
        container.classList.remove('container');
        container.classList.add('container-fluid');
    }
</script>
<nav class="navbar navbar-light navbar-vertical navbar-expand-xl" style="display: none;">
    <script>
        var navbarStyle = localStorage.getItem("navbarStyle");
        if (navbarStyle && navbarStyle !== 'transparent') {
            document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
        }
    </script>
    <div class="d-flex align-items-center">
        <div class="toggle-icon-wrapper">
            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle"
                data-bs-toggle="tooltip" data-bs-placement="left" title="Toggle Navigation"><span
                    class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
        </div><a class="navbar-brand" href="index.html">
            <div class="d-flex align-items-center py-2"><img class="me-2"
                    src="{{ asset('/') }}assets/img/icons/spot-illustrations/vetfull.png" alt=""
                    width="75" /><span class="font-sans-serif"></span></div>
        </a>
    </div>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content scrollbar">
            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                @include('layouts.staff.nav.partials.navbarVerticalNav')
            </ul>
            <div class="settings mb-3">
                @include('layouts.staff.nav.partials.sidebarcard')
            </div>
        </div>
    </div>
</nav>
<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg" style="display: none;">
    <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button"
        data-bs-toggle="collapse" data-bs-target="#navbarStandard" aria-controls="navbarStandard"
        aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span
                class="toggle-line"></span></span></button>
    <a class="navbar-brand me-1 me-sm-3" href="index.html">
        <div class="d-flex align-items-center"><img class="me-2"
                src="{{ asset('/') }}assets/img/icons/spot-illustrations/falcon.png" alt=""
                width="40" /><span class="font-sans-serif">SAB</span></div>
    </a>
    <div class="collapse navbar-collapse scrollbar" id="navbarStandard">
        <ul class="navbar-nav" data-top-nav-dropdowns="data-top-nav-dropdowns">
            @include('layouts.staff.nav.partials.navbarStandard')
        </ul>
    </div>
    <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
        @include('layouts.staff.nav.partials.navbar-nav-icons')
    </ul>
</nav>
