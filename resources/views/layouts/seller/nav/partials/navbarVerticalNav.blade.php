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
            <a class="nav-link @if(request()->routeIs('seller.dashboard')) active @endif" href="{{ route('seller.dashboard') }}">
                <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-home"></span></span><span
                        class="nav-link-text ps-1">Dashboard</span></div>
            </a><!-- more inner pages-->
        </li>
    </ul>
</li>

<li class="nav-item">
    <!-- label-->
    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
        <div class="col-auto navbar-vertical-label">Orders Management</div>
        <div class="col ps-0">
            <hr class="mb-0 navbar-vertical-divider" />
        </div>
    </div><!-- parent pages-->
    <a class="nav-link @if(request()->routeIs('seller.pendingOrders')) active @endif" href="{{ route('seller.pendingOrders') }}">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-spinner"></span></span><span
        class="nav-link-text ps-1">Pending Orders</span></div>
    </a><!-- more inner pages-->

    <a class="nav-link @if(request()->routeIs('seller.completedOrders')) active @endif" href="{{ route('seller.completedOrders') }}">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-check-circle"></span></span><span
        class="nav-link-text ps-1">Completed Orders</span></div>
    </a><!-- more inner pages-->

   <a class="nav-link @if (request()->routeIs('seller.paidOrders')) active @endif" href="{{ route('seller.paidOrders') }}">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-credit-card"></span></span><span
        class="nav-link-text ps-1">Paid Orders</span></div>
    </a><!-- more inner pages-->

    <a class="nav-link @if (request()->routeIs('seller.unPaidOrders')) active @endif" href="{{ route('seller.unPaidOrders') }}">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-frown"></span></span><span
        class="nav-link-text ps-1">Unpaid & Overdue</span></div>
    </a><!-- more inner pages-->

    <a class="nav-link @if(request()->routeIs('seller.rejectedOrders')) active @endif" href="{{ route('seller.rejectedOrders') }}">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-times-circle"></span></span><span
        class="nav-link-text ps-1">Cancelled Orders</span></div>
    </a><!-- more inner pages-->

</li>



<li class="nav-item">
    <!-- label-->
    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
        <div class="col-auto navbar-vertical-label">Products Management</div>
        <div class="col ps-0">
            <hr class="mb-0 navbar-vertical-divider" />
        </div>
    </div><!-- parent pages-->
    <a class="nav-link @if(request()->routeIs('seller.myproducts')) active @endif" href="{{ route('seller.myproducts') }}">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-list"></span></span><span
        class="nav-link-text ps-1">My Products</span></div>
    </a><!-- more inner pages-->

    <a class="nav-link @if(request()->routeIs('seller.rejectedProducts')) active @endif" href="{{ route('seller.rejectedProducts') }}">
    <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-shopping-cart"></span></span><span
        class="nav-link-text ps-1">Rejected Posts</span></div>
    </a><!-- more inner pages-->
</li>

<li class="nav-item">
    <!-- label-->
    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
        <div class="col-auto navbar-vertical-label">Business Management</div>
        <div class="col ps-0">
            <hr class="mb-0 navbar-vertical-divider" />
        </div>
    </div><!-- parent pages-->
    <a class="nav-link @if(request()->routeIs('seller.my-shop')) active @endif" href="{{ route('seller.my-shop') }}">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-university"></span></span><span
        class="nav-link-text ps-1">My Shop</span></div>
    </a><!-- more inner pages-->

   <a class="nav-link @if(request()->routeIs('seller.bank-info')) active @endif" href="{{ route('seller.bank-info') }}">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fas fa-credit-card"></span></span><span
        class="nav-link-text ps-1">Bank Info</span></div>
    </a><!-- more inner pages-->

    <a class="nav-link @if(request()->routeIs('seller.my-wallet')) active @endif" href="{{ route('seller.my-wallet') }}">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fa fa-envelope"></span></span><span
        class="nav-link-text ps-1">My Wallet</span></div>
    </a><!-- more inner pages-->

    <a class="nav-link @if(request()->routeIs('seller.reviews')) active @endif" href="{{ route('seller.reviews') }}">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
            class="fa fa-star"></span></span><span
        class="nav-link-text ps-1">Reviews</span></div>
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
