<li class="nav-item">
    <!-- parent pages--><a class="nav-link dropdown-indicator" href="#dashboard"
        role="button" data-bs-toggle="collapse" aria-expanded="true"
        aria-controls="dashboard">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                    class="fas fa-chart-pie"></span></span><span
                class="nav-link-text ps-1">Dashboard</span></div>
    </a>
    <ul class="nav collapse show" id="dashboard">
        <li class="nav-item">
            <a class="nav-link @if(request()->routeIs('admin.dashboard.home')) active @endif" href="{{ route('admin.dashboard.home') }}">
                <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-home"></span></span><span
                        class="nav-link-text ps-1">Home</span></div>
            </a><!-- more inner pages-->
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link @if(request()->routeIs('admin.dashboard.analytics')) active @endif" href="{{ route('admin.dashboard.analytics') }}">
                <div class="d-flex align-items-center"><span
                        class="nav-link-text ps-1">Analytics</span></div>
            </a><!-- more inner pages-->
        </li>
        <li class="nav-item">
            <a class="nav-link @if(request()->routeIs('admin.dashboard.crm')) active @endif" href="{{ route('admin.dashboard.crm') }}">
                <div class="d-flex align-items-center"><span
                        class="nav-link-text ps-1">CRM</span></div>
            </a><!-- more inner pages--> --}}
        {{-- </li> --}}
        {{-- <li class="nav-item">
            <a class="nav-link @if(request()->routeIs('admin.dashboard.shop')) active @endif" href="{{ route('admin.dashboard.shop') }}">
                <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-shopping-bag"></span></span><span
                        class="nav-link-text ps-1">Admin POS</span>
                </div>
            </a><!-- more inner pages-->
        </li> --}}
        {{-- <li class="nav-item">
            <a class="nav-link @if(request()->routeIs('admin.dashboard.lms')) active @endif" href="{{ route('admin.dashboard.lms') }}">
                <div class="d-flex align-items-center"><span
                        class="nav-link-text ps-1">LMS</span>
                        <span class="badge rounded-pill ms-2 badge-subtle-success">new</span>
                </div>
            </a><!-- more inner pages-->
        </li>
        <li class="nav-item">
            <a class="nav-link @if(request()->routeIs('admin.dashboard.management')) active @endif" href="{{ route('admin.dashboard.management') }}">
                <div class="d-flex align-items-center"><span
                        class="nav-link-text ps-1">Management</span></div>
            </a><!-- more inner pages-->
        </li>
        <li class="nav-item">
            <a class="nav-link @if(request()->routeIs('admin.dashboard.saas')) active @endif" href="{{ route('admin.dashboard.saas') }}">
            <div class="d-flex align-items-center"><span
                    class="nav-link-text ps-1">SaaS</span></div>
        </a><!-- more inner pages-->
        </li>
        <li class="nav-item">
            <a class="nav-link @if(request()->routeIs('admin.dashboard.support')) active @endif" href="{{ route('admin.dashboard.support') }}">
                <div class="d-flex align-items-center"><span
                        class="nav-link-text ps-1">Support Desk</span>
                        <span class="badge rounded-pill ms-2 badge-subtle-success">new</span>
                </div>
            </a><!-- more inner pages-->
        </li> --}}
    </ul>
</li>

<li class="nav-item">
    <!-- label-->

    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
        <div class="col-auto navbar-vertical-label">Manage Users</div>
        <div class="col ps-0">
            <hr class="mb-0 navbar-vertical-divider" />
        </div>
    </div><!-- parent pages-->
    <a class="nav-link @if(request()->routeIs('admin.listadmins')) active @endif" href="{{ route('admin.listadmins') }}">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-user-circle"></span></span><span
        class="nav-link-text ps-1">Dodoki Admins</span></div>
    </a><!-- more inner pages-->

    <a class="nav-link @if(request()->routeIs('admin.liststaffs')) active @endif"  href="{{ route('admin.liststaffs') }}">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-users"></span></span><span
        class="nav-link-text ps-1">Staffs</span></div>
    </a><!-- more inner pages-->

    <a class="nav-link @if(request()->routeIs('admin.listbranches')) active @endif"  href="{{ route('admin.listbranches') }}">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-university"></span></span><span
        class="nav-link-text ps-1">Our Branches</span></div>
    </a>

    <a class="nav-link @if(request()->routeIs('admin.listagents')) active @endif"  href="{{ route('admin.listagents') }}">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-user-secret"></span></span><span
        class="nav-link-text ps-1">Our Customers</span></div>
    </a>
</li>

<li class="nav-item">
    <!-- label-->
    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
        <div class="col-auto navbar-vertical-label">Manage Products</div>
        <div class="col ps-0">
            <hr class="mb-0 navbar-vertical-divider" />
        </div>
    </div><!-- parent pages-->
    <a class="nav-link @if(request()->routeIs('admin.products.listproducts')) active @endif" href="{{ route('admin.products.listproducts') }}">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-cubes"></span></span><span
        class="nav-link-text ps-1">Products</span></div>
    </a><!-- more inner pages-->

</li>
{{-- <li class="nav-item">
    <!-- label-->
    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
        <div class="col-auto navbar-vertical-label">Manage Categories</div>
        <div class="col ps-0">
            <hr class="mb-0 navbar-vertical-divider" />
        </div>
    </div><!-- parent pages-->
    <a class="nav-link @if(request()->routeIs('admin.listproductcategory')) active @endif" href="{{ route('admin.listproductcategory') }}">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-cubes"></span></span><span
        class="nav-link-text ps-1">Product Categories</span></div>
    </a><!-- more inner pages-->

    <a class="nav-link @if(request()->routeIs('admin.listservicecategory')) active @endif" href="{{ route('admin.listservicecategory') }} ">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-archive "></span></span><span
        class="nav-link-text ps-1">Service Categories</span></div>
    </a><!-- more inner pages-->
</li> --}}

{{-- <li class="nav-item">
    <!-- label-->
    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
        <div class="col-auto navbar-vertical-label">Manage Catalogs</div>
        <div class="col ps-0">
            <hr class="mb-0 navbar-vertical-divider" />
        </div>
    </div><!-- parent pages-->
    <a class="nav-link @if(request()->routeIs('admin.sabproducts.*')) active @endif" href="{{ route('admin.sabproducts.list') }}">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-list"></span></span><span
        class="nav-link-text ps-1">SAB Products</span></div>
    </a><!-- more inner pages-->

   <a class="nav-link @if(request()->routeIs('admin.marketproducts.*')) active @endif" href="{{ route('admin.marketproducts.list') }}">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-shopping-cart"></span></span><span
        class="nav-link-text ps-1">Market Products</span></div>
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
    <a class="nav-link @if(request()->routeIs('admin.createOrder')) active @endif" href="{{ route('admin.createOrder') }} ">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fa fa-cart-plus"></span></span><span
        class="nav-link-text ps-1">Create Order</span></div>
    </a><!-- more inner pages-->

    <a class="nav-link @if(request()->routeIs('admin.pendingOrder')) active @endif" href="{{ route('admin.pendingOrder') }} ">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-spinner"></span></span><span
        class="nav-link-text ps-1">Pending Orders</span></div>
    </a><!-- more inner pages-->

    <a class="nav-link @if(request()->routeIs('admin.partialorder')) active @endif" href="{{ route('admin.partialorder') }} ">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-spinner fa-spin"></span></span><span
        class="nav-link-text ps-1">Partial Orders</span></div>
    </a><!-- more inner pages-->

    <a class="nav-link @if(request()->routeIs('admin.paypointorder')) active @endif" href="{{ route('admin.paypointorder') }} ">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fa fa-barcode"></span></span><span
        class="nav-link-text ps-1">Pay-Point Orders</span></div>
    </a><!-- more inner pages-->

    <a class="nav-link @if(request()->routeIs('admin.completedorder')) active @endif" href="{{ route('admin.completedorder') }}">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-check-circle"></span></span><span
        class="nav-link-text ps-1">Completed Orders</span></div>
    </a><!-- more inner pages-->

   <a class="nav-link @if(request()->routeIs('admin.rejectedorder')) active @endif" href="{{ route('admin.rejectedorder') }}">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-times-circle"></span></span><span
        class="nav-link-text ps-1">Rejected Orders</span></div>
    </a><!-- more inner pages-->

</li>

{{-- <li class="nav-item">
    <!-- label-->
    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
        <div class="col-auto navbar-vertical-label">Manage Transactions</div>
        <div class="col ps-0">
            <hr class="mb-0 navbar-vertical-divider" />
        </div>
    </div><!-- parent pages-->
    <a class="nav-link @if(request()->routeIs('admin.pendingInvoice')) active @endif" href="{{ route('admin.pendingInvoice') }}">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-university"></span></span><span
        class="nav-link-text ps-1">Pending Invoices</span></div>
    </a><!-- more inner pages-->

   <a class="nav-link @if(request()->routeIs('admin.paidInvoice')) active @endif" href="{{ route('admin.paidInvoice') }}">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-credit-card"></span></span><span
        class="nav-link-text ps-1">Paid Invoices</span></div>
    </a><!-- more inner pages-->

    <a class="nav-link @if(request()->routeIs('admin.overDueInvoice')) active @endif" href="{{ route('admin.overDueInvoice') }}">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-frown"></span></span><span
        class="nav-link-text ps-1">OverDue Invoices</span></div>
    </a><!-- more inner pages-->

    <a class="nav-link @if(request()->routeIs('admin.withdrawalReq')) active @endif" href="{{ route('admin.withdrawalReq') }}">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-list"></span></span><span
        class="nav-link-text ps-1">Withdrawals</span></div>
    </a>
</li> --}}

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
