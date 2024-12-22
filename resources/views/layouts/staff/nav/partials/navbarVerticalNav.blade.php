<li class="nav-item">
    <!-- label-->

    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
        <div class="col-auto navbar-vertical-label">Manage Users</div>
        <div class="col ps-0">
            <hr class="mb-0 navbar-vertical-divider" />
        </div>
    </div><!-- parent pages-->

    <a class="nav-link @if(request()->routeIs('staff.listagents')) active @endif"  href="{{ route('staff.listagents') }}">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-user-secret"></span></span><span
        class="nav-link-text ps-1">Our Customers</span></div>
    </a>

    <a class="nav-link @if(request()->routeIs('staff.listbranches')) active @endif"  href="{{ route('staff.listbranches') }}">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-university"></span></span><span
        class="nav-link-text ps-1">Our Branches</span></div>
    </a>
</li>

{{-- <li class="nav-item">
    <!-- label-->
    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
        <div class="col-auto navbar-vertical-label">Manage Products</div>
        <div class="col ps-0">
            <hr class="mb-0 navbar-vertical-divider" />
        </div>
    </div><!-- parent pages-->
    <a class="nav-link @if(request()->routeIs('staff.products.listproducts')) active @endif" href="{{ route('staff.products.listproducts') }}">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-cubes"></span></span><span
        class="nav-link-text ps-1">Products</span></div>
    </a><!-- more inner pages-->

</li> --}}


<li class="nav-item">
    <!-- label-->
    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
        <div class="col-auto navbar-vertical-label">Manage Orders</div>
        <div class="col ps-0">
            <hr class="mb-0 navbar-vertical-divider" />
        </div>
    </div><!-- parent pages-->
    <a class="nav-link @if(request()->routeIs('staff.createorder')) active @endif" href="{{ route('staff.createorder') }} ">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fa fa-cart-plus"></span></span><span
        class="nav-link-text ps-1">Create Order</span></div>
    </a><!-- more inner pages-->

    <a class="nav-link @if(request()->routeIs('staff.pendingOrder')) active @endif" href="{{ route('staff.pendingOrder') }} ">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-spinner"></span></span><span
        class="nav-link-text ps-1">Pending Orders</span></div>
    </a><!-- more inner pages-->

    <a class="nav-link @if(request()->routeIs('staff.partialorder')) active @endif" href="{{ route('staff.partialorder') }} ">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-spinner fa-spin"></span></span><span
        class="nav-link-text ps-1">Partial/Credit Orders</span></div>
    </a><!-- more inner pages-->

    <a class="nav-link @if(request()->routeIs('staff.completedorder')) active @endif" href="{{ route('staff.completedorder') }}">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-check-circle"></span></span><span
        class="nav-link-text ps-1">Completed Orders</span></div>
    </a><!-- more inner pages-->

   <a class="nav-link @if(request()->routeIs('staff.rejectedorder')) active @endif" href="{{ route('staff.rejectedorder') }}">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-times-circle"></span></span><span
        class="nav-link-text ps-1">Rejected Orders</span></div>
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
