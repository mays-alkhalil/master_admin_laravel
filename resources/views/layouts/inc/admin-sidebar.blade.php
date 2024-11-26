<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <!-- Dashboard Section -->
                <div class="sb-sidenav-menu-heading">Dashboard</div>
                <a class="nav-link {{ Request ::is('admin/dashboard') ? 'active':''}}" href="{{ url('admin/dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link {{ Request::is('user-chart') ? 'active' : '' }}" href="{{ url('user-chart') }}">
    <div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>
    Charts
</a>


                <!-- Category Section -->
                <div class="sb-sidenav-menu-heading">Product Management</div>
                                <!-- Stores Section -->
                                <a class="nav-link {{ Request ::is('admin/stores') ? 'active':''}}" href="{{ url('admin/stores') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-store"></i></div>
                    Stores
                </a>

                <a class="nav-link {{ Request::is('admin/category') || Request::is('admin/add-category') || Request::is('admin/edit-category/*') ? 'active' : '' }}" href="{{ url('admin/category') }}">
    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
    Categories
</a>

                   <!-- Products Section -->
                   <a class="nav-link {{ Request ::is('admin/products') ? 'active':''}}" href="{{ url('admin/products') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                    Products
                </a>

                <!-- Reviews -->
                <a class="nav-link {{ Request::is('admin/reviews') ? 'active':''}}" href="{{ url('admin/reviews') }}">
    <div class="sb-nav-link-icon"><i class="fas fa-star"></i></div>
    Reviews
</a>
                <!-- Users Section -->
             

             

                <!-- Orders Section -->
                <a class="nav-link {{ Request ::is('admin/orders') ? 'active':''}}" href="{{ url('admin/orders') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-receipt"></i></div>
                    Orders
                </a>
                <!-- COUPONS Section -->
                <a class="nav-link {{ Request ::is('admin/coupons') ? 'active':''}}" href="{{ url('admin/coupons') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-gift"></i></div>
                    Coupons
                </a>

                <a class="nav-link {{ Request ::is('admin/users') ? 'active':''}}" href="{{ url('admin/users') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    Users
                </a>


                <!-- Contacts Section -->
                <a class="nav-link {{ Request ::is('admin/contacts') ? 'active':''}}" href="{{ url('admin/contacts') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></div>
                    Contacts
                </a>

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <div>{{ Auth::user()->name }}</div>
        </div>
    </nav>
</div>
