<li class="nav-item px-2">
    <div class="theme-control-toggle fa-icon-wait"><input
            class="form-check-input ms-0 theme-control-toggle-input" id="themeControlToggle"
            type="checkbox" data-theme-control="theme" value="dark" /><label
            class="mb-0 theme-control-toggle-label theme-control-toggle-light"
            for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"
            title="Switch to light theme"><span class="fas fa-sun fs-0"></span></label><label
            class="mb-0 theme-control-toggle-label theme-control-toggle-dark"
            for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"
            title="Switch to dark theme"><span class="fas fa-moon fs-0"></span></label></div>
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
        @include('layouts.staff.nav.partials.navbarDropdownNotification')
    </div>
</li>
<li class="nav-item dropdown px-1">
    <a class="nav-link fa-icon-wait nine-dots p-1" id="navbarDropdownMenu" role="button"
        data-hide-on-body-scroll="data-hide-on-body-scroll" data-bs-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg"
            width="16" height="43" viewBox="0 0 16 16" fill="none">
            <circle cx="2" cy="2" r="2" fill="#6C6E71"></circle>
            <circle cx="2" cy="8" r="2" fill="#6C6E71"></circle>
            <circle cx="2" cy="14" r="2" fill="#6C6E71"></circle>
            <circle cx="8" cy="8" r="2" fill="#6C6E71"></circle>
            <circle cx="8" cy="14" r="2" fill="#6C6E71"></circle>
            <circle cx="14" cy="8" r="2" fill="#6C6E71"></circle>
            <circle cx="14" cy="14" r="2" fill="#6C6E71"></circle>
            <circle cx="8" cy="2" r="2" fill="#6C6E71"></circle>
            <circle cx="14" cy="2" r="2" fill="#6C6E71"></circle>
        </svg>
    </a>
</li>
<li class="nav-item dropdown"><a class="nav-link pe-0 ps-2" id="navbarDropdownUser"
        role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div class="avatar avatar-xl">
            <img class="rounded-circle" src="{{ asset('/') }}assets/img/team/3-thumb.png" alt="" />
        </div>
    </a>
    <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0"
        aria-labelledby="navbarDropdownUser">
        <div class="bg-white dark__bg-1000 rounded-2 py-2">
            <a class="dropdown-item fw-bold text-warning" href="#!"><span
                    class="fas fa-crown me-1"></span><span>Go Pro</span></a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#!">Set status</a>
            <a class="dropdown-item" href="pages/user/profile.html">Profile &amp; account</a>
            <a class="dropdown-item" href="#!">Feedback</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="pages/user/settings.html">Settings</a>
            <a class="dropdown-item" href="pages/authentication/card/logout.html">Logout</a>
        </div>
    </div>
</li>
