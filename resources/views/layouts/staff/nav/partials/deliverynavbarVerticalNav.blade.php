
<li class="nav-item">
    <!-- label-->
    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
        <div class="col-auto navbar-vertical-label">Manage Deliveries</div>
        <div class="col ps-0">
            <hr class="mb-0 navbar-vertical-divider" />
        </div>
    </div><!-- parent pages-->

    <a class="nav-link @if(request()->routeIs('staff.deliveries')) active @endif" href="{{ route('staff.deliveries') }} ">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-spinner fa-spin"></span></span><span
        class="nav-link-text ps-1">Deliveries</span></div>
    </a><!-- more inner pages-->

</li>


<li class="nav-item">
        <!-- label-->
        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
            <div class="col-auto navbar-vertical-label">App</div>
            <div class="col ps-0">
                <hr class="mb-0 navbar-vertical-divider" />
            </div>
        </div><!-- parent pages-->
        <a class="nav-link" href="javascript:void(0);"
            role="button" data-bs-toggle="modal" data-bs-target="#logout">
            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                        class="fas fa-sign-out-alt"></span></span><span
                    class="nav-link-text ps-1">Log Out</span></div>
        </a>
</li>
