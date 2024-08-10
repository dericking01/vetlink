<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand" style="display: none;">
    <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button"
        data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse"
        aria-controls="navbarVerticalCollapse" aria-expanded="false"
        aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span
                class="toggle-line"></span></span></button>
    <a class="navbar-brand me-1 me-sm-3" href="index.html">
        <div class="d-flex align-items-center"><img class="me-2"
                src="{{ asset('/') }}assets/img/icons/spot-illustrations/dodoki.png" alt=""
                width="40" /><span class="font-sans-serif"></span></div>
    </a>
    <ul class="navbar-nav align-items-center d-none d-lg-block">
        <li class="nav-item">
            {{-- @include('layouts.staff.nav.partials.search-box') --}}
        </li>
    </ul>
    <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
        <li class="nav-item px-2">
            <div class="theme-control-toggle fa-icon-wait"><input
                    class="form-check-input ms-0 theme-control-toggle-input" id="themeControlToggle"
                    type="checkbox" data-theme-control="theme" value="dark" /><label
                    class="mb-0 theme-control-toggle-label theme-control-toggle-light"
                    for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"
                    title="Switch to light theme"><span
                        class="fas fa-sun fs-0"></span></label><label
                    class="mb-0 theme-control-toggle-label theme-control-toggle-dark"
                    for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"
                    title="Switch to dark theme"><span class="fas fa-moon fs-0"></span></label>
            </div>
        </li>
        <li class="nav-item dropdown"><a class="nav-link pe-0 ps-2" id="navbarDropdownUser"
                role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <div class="avatar avatar-xl">
                    {{-- <span>{{ \App\Helpers\SettingsHelper::getstaffInitials($staff->id) }}</span> --}}
                    <img class="rounded-circle" src="{{ asset('/') }}assets/img/team/avatar.png"
                        alt="" />
                </div>
            </a>
            <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0"
                aria-labelledby="navbarDropdownUser">
                <div class="bg-white dark__bg-1000 rounded-2 py-2">
                    <a class="dropdown-item fw-bold text-warning" href="#!"><span
                            class="fas fa-crow me-1"></span><span>{{auth('staff')->user()->name}}</span></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('forgotpassword') }}">Change Password</a>
                    {{-- <a class="dropdown-item" href="javascript:void(0);">Profile &amp;
                        account</a>
                    <a class="dropdown-item" href="#!">Feedback</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:void(0);">Settings</a> --}}
                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                    data-bs-target="#logout">Logout</a>
                </div>
            </div>
        </li>
    </ul>
</nav>
<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg" style="display: none;"
    data-move-target="#navbarVerticalNav" data-navbar-top="combo">
    <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button"
        data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse"
        aria-controls="navbarVerticalCollapse" aria-expanded="false"
        aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span
                class="toggle-line"></span></span></button>
    <a class="navbar-brand me-1 me-sm-3" href="index.html">
        <div class="d-flex align-items-center"><img class="me-2"
                src="{{ asset('/') }}assets/img/icons/spot-illustrations/falcon.png" alt=""
                width="40" /><span class="font-sans-serif">VETLINK</span></div>
    </a>
    <div class="collapse navbar-collapse scrollbar" id="navbarStandard">
        <ul class="navbar-nav" data-top-nav-dropdowns="data-top-nav-dropdowns">
            @include('layouts.staff.nav.partials.navbarStandard')

        </ul>
    </div>
    <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
        <li class="nav-item px-2">
            <div class="theme-control-toggle fa-icon-wait"><input
                    class="form-check-input ms-0 theme-control-toggle-input" id="themeControlToggle"
                    type="checkbox" data-theme-control="theme" value="dark" /><label
                    class="mb-0 theme-control-toggle-label theme-control-toggle-light"
                    for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"
                    title="Switch to light theme"><span
                        class="fas fa-sun fs-0"></span></label><label
                    class="mb-0 theme-control-toggle-label theme-control-toggle-dark"
                    for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"
                    title="Switch to dark theme"><span class="fas fa-moon fs-0"></span></label>
            </div>
        </li>
        <li class="nav-item d-none d-sm-block">
            <a class="nav-link px-0 notification-indicator notification-indicator-warning notification-indicator-fill fa-icon-wait"
                href="app/e-commerce/shopping-cart.html"><span class="fas fa-shopping-cart"
                    data-fa-transform="shrink-7" style="font-size: 33px;"></span><span
                    class="notification-indicator-number">1</span></a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link notification-indicator notification-indicator-primary px-0 fa-icon-wait"
                id="navbarDropdownNotification" role="button" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false"
                data-hide-on-body-scroll="data-hide-on-body-scroll"><span class="fas fa-bell"
                    data-fa-transform="shrink-6" style="font-size: 33px;"></span></a>
            <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end dropdown-menu-card dropdown-menu-notification dropdown-caret-bg"
                aria-labelledby="navbarDropdownNotification">
                <div class="card card-notification shadow-none">
                    <div class="card-header">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                <h6 class="card-header-title mb-0">Notifications</h6>
                            </div>
                            <div class="col-auto ps-0 ps-sm-3"><a class="card-link fw-normal"
                                    href="#">Mark all as read</a></div>
                        </div>
                    </div>
                    <div class="scrollbar-overlay" style="max-height:19rem">
                        <div class="list-group list-group-flush fw-normal fs--1">
                            <div class="list-group-title border-bottom">NEW</div>
                            <div class="list-group-item">
                                <a class="notification notification-flush notification-unread"
                                    href="#!">
                                    <div class="notification-avatar">
                                        <div class="avatar avatar-2xl me-3">
                                            <img class="rounded-circle"
                                                src="{{ asset('/') }}assets/img/team/1-thumb.png" alt="" />
                                        </div>
                                    </div>
                                    <div class="notification-body">
                                        <p class="mb-1"><strong>Emma Watson</strong> replied to your
                                            comment : "Hello world 😍"</p>
                                        <span class="notification-time"><span class="me-2"
                                                role="img" aria-label="Emoji">💬</span>Just
                                            now</span>
                                    </div>
                                </a>
                            </div>
                            <div class="list-group-item">
                                <a class="notification notification-flush notification-unread"
                                    href="#!">
                                    <div class="notification-avatar">
                                        <div class="avatar avatar-2xl me-3">
                                            <div class="avatar-name rounded-circle"><span>AB</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="notification-body">
                                        <p class="mb-1"><strong>Albert Brooks</strong> reacted to
                                            <strong>Mia Khalifa's</strong> status</p>
                                        <span class="notification-time"><span
                                                class="me-2 fab fa-gratipay text-danger"></span>9hr</span>
                                    </div>
                                </a>
                            </div>
                            <div class="list-group-title border-bottom">EARLIER</div>
                            <div class="list-group-item">
                                <a class="notification notification-flush" href="#!">
                                    <div class="notification-avatar">
                                        <div class="avatar avatar-2xl me-3">
                                            <img class="rounded-circle"
                                                src="{{ asset('/') }}assets/img/icons/weather-sm.jpg"
                                                alt="" />
                                        </div>
                                    </div>
                                    <div class="notification-body">
                                        <p class="mb-1">The forecast today shows a low of 20&#8451;
                                            in California. See today's weather.</p>
                                        <span class="notification-time"><span class="me-2"
                                                role="img"
                                                aria-label="Emoji">🌤️</span>1d</span>
                                    </div>
                                </a>
                            </div>
                            <div class="list-group-item">
                                <a class="border-bottom-0 notification-unread  notification notification-flush"
                                    href="#!">
                                    <div class="notification-avatar">
                                        <div class="avatar avatar-xl me-3">
                                            <img class="rounded-circle"
                                                src="{{ asset('/') }}assets/img/logos/oxford.png" alt="" />
                                        </div>
                                    </div>
                                    <div class="notification-body">
                                        <p class="mb-1"><strong>University of Oxford</strong>
                                            created an event : "Causal Inference Hilary 2019"</p>
                                        <span class="notification-time"><span class="me-2"
                                                role="img" aria-label="Emoji">✌️</span>1w</span>
                                    </div>
                                </a>
                            </div>
                            <div class="list-group-item">
                                <a class="border-bottom-0 notification notification-flush"
                                    href="#!">
                                    <div class="notification-avatar">
                                        <div class="avatar avatar-xl me-3">
                                            <img class="rounded-circle" src="{{ asset('/') }}assets/img/team/10.jpg"
                                                alt="" />
                                        </div>
                                    </div>
                                    <div class="notification-body">
                                        <p class="mb-1"><strong>James Cameron</strong> invited to
                                            join the group: United Nations International Children's Fund
                                        </p>
                                        <span class="notification-time"><span class="me-2"
                                                role="img"
                                                aria-label="Emoji">🙋‍</span>2d</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center border-top"><a class="card-link d-block"
                            href="app/social/notifications.html">View all</a></div>
                </div>
            </div>
        </li>
        <li class="nav-item dropdown px-1">
            <a class="nav-link fa-icon-wait nine-dots p-1" id="navbarDropdownMenu" role="button"
                data-hide-on-body-scroll="data-hide-on-body-scroll" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg"
                    width="16" height="43" viewBox="0 0 16 16" fill="none">
                    <circle cx="2" cy="2" r="2" fill="#6C6E71">
                    </circle>
                    <circle cx="2" cy="8" r="2" fill="#6C6E71">
                    </circle>
                    <circle cx="2" cy="14" r="2" fill="#6C6E71">
                    </circle>
                    <circle cx="8" cy="8" r="2" fill="#6C6E71">
                    </circle>
                    <circle cx="8" cy="14" r="2" fill="#6C6E71">
                    </circle>
                    <circle cx="14" cy="8" r="2" fill="#6C6E71">
                    </circle>
                    <circle cx="14" cy="14" r="2" fill="#6C6E71">
                    </circle>
                    <circle cx="8" cy="2" r="2" fill="#6C6E71">
                    </circle>
                    <circle cx="14" cy="2" r="2" fill="#6C6E71">
                    </circle>
                </svg>
            </a>
            <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end dropdown-menu-card dropdown-caret-bg"
                aria-labelledby="navbarDropdownMenu">
                @include('layouts.staff.nav.partials.navbarDropdownMenu')
            </div>
        </li>
        <li class="nav-item dropdown"><a class="nav-link pe-0 ps-2" id="navbarDropdownUser"
                role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <div class="avatar avatar-xl">
                    <img class="rounded-circle" src="{{ asset('/') }}assets/img/team/3-thumb.png"
                        alt="" />
                </div>
            </a>
            <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0"
                aria-labelledby="navbarDropdownUser">
            @include('layouts.staff.nav.partials.navbarDropdownUser')
            </div>
        </li>
    </ul>
</nav>
<script>
    var navbarPosition = localStorage.getItem('navbarPosition');
    var navbarVertical = document.querySelector('.navbar-vertical');
    var navbarTopVertical = document.querySelector('.content .navbar-top');
    var navbarTop = document.querySelector('[data-layout] .navbar-top:not([data-double-top-nav');
    var navbarDoubleTop = document.querySelector('[data-double-top-nav]');
    var navbarTopCombo = document.querySelector('.content [data-navbar-top="combo"]');

    if (localStorage.getItem('navbarPosition') === 'double-top') {
        document.documentElement.classList.toggle('double-top-nav-layout');
    }

    if (navbarPosition === 'top') {
        navbarTop.removeAttribute('style');
        navbarTopVertical.remove(navbarTopVertical);
        navbarVertical.remove(navbarVertical);
        navbarTopCombo.remove(navbarTopCombo);
        navbarDoubleTop.remove(navbarDoubleTop);
    } else if (navbarPosition === 'combo') {
        navbarVertical.removeAttribute('style');
        navbarTopCombo.removeAttribute('style');
        navbarTop.remove(navbarTop);
        navbarTopVertical.remove(navbarTopVertical);
        navbarDoubleTop.remove(navbarDoubleTop);
    } else if (navbarPosition === 'double-top') {
        navbarDoubleTop.removeAttribute('style');
        navbarTopVertical.remove(navbarTopVertical);
        navbarVertical.remove(navbarVertical);
        navbarTop.remove(navbarTop);
        navbarTopCombo.remove(navbarTopCombo);
    } else {
        navbarVertical.removeAttribute('style');
        navbarTopVertical.removeAttribute('style');
        navbarTop.remove(navbarTop);
        navbarDoubleTop.remove(navbarDoubleTop);
        navbarTopCombo.remove(navbarTopCombo);
    }
</script>

<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
        <div class="modal-content position-relative">
            <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="logout-form" action="{{ route('staff.logout') }}" method="POST">
                @csrf
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1" id="modalExampleDemoLabel">Confirm Logout </h4>
                    </div>
                    <div class="p-4 pb-0">

                        <div class="modal-body">
                            <div class="modal-icon text-center mb-3">
                                <i class="fas fa-sign-out-alt text-danger fa-3x"></i>
                            </div>
                            <div class="modal-text text-center">
                                <h2 class="text-danger">Confirm Logout</h2>
                                <p>Are you sure you want to logout?</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-danger" type="submit" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Logout </button>
                </div>
            </form>
        </div>
    </div>
</div>
