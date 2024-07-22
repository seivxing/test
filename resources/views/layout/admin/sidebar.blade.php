<div class="sidebar pe-4 pb-3">

    <nav class="navbar bg-light navbar-light">
        <a href="{{ route('dashboard') }}" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary">{{ setting('app_name') }}</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">

            </div>
            <div class="ms-3">
                <h6 class="mb-0"><livewire:navbar-component /></h6>
                {{-- <span>Admin</span> --}}
            </div>
        </div>
        <div class="navbar-nav w-100">
            @if (Auth::user()->role == 1)
            <a href="{{ route('dashboard') }}" class="nav-item nav-link @yield('dashboard')"><i
                    class="fa fa-tachometer-alt me-2"></i>Dashboard</a>

            {{-- TODO: PRODUCT --}}
            <a href="{{ route('sale') }}" class="nav-item nav-link @yield('sale')"><i
                    class="fa-solid fa-cart-shopping"></i>Directly Buy</a>
            <a href="{{ route('productcategory_index') }}" class="nav-item nav-link @yield('productcategory')"><i
                    class="fas fa-th-list"></i>Category</a>
            <a href="{{ route('productbrand_index') }}" class="nav-item nav-link @yield('productbrand')"><i
                    class="fa-solid fa-b"></i>Brand</a>
            <a href="{{ route('product_index') }}" class="nav-item nav-link @yield('product')"><i
                    class="fa-brands fa-product-hunt"></i>Product</a>
            {{-- Stock Product --}}
            <a href="{{ route('renewstockproduct') }}" class="nav-item nav-link @yield('renewstockproduct')"><i
                    class="fas fa-cubes"></i>Renew Stock</a>
            <a href="{{ route('addstockproduct') }}" class="nav-item nav-link @yield('addstockproduct')"><i
                    class="far fa-calendar-plus"></i>Add Stock</a>
            <a href="{{ route('slider_index') }}" class="nav-item nav-link @yield('slider')"><i
                    class="fa-brands fa-product-hunt"></i>Slider</a>
            {{-- Product Tracking --}}
            <a href="{{ route('producttracking_index') }}" class="nav-item nav-link @yield('producttracking')"><i
                    class="fas fa-map"></i> Product Tracking</a>
            <li class="nav-item">
                <a class="nav-link @yield('setting')" data-bs-toggle="collapse" href="#ui-basic-1" aria-expanded="false"
                    aria-controls="ui-basic-1">
                    <i class="fas fa-cog"></i>
                    <span class="menu-title">Setting</span>
                </a>
                <div class="collapse" id="ui-basic-1">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link @yield('introduction')"
                                href="{{ route('introduction_setting') }}"><i
                                    class="fas fa-desktop"></i>Introduction</a></li>
                        <li class="nav-item"> <a class="nav-link @yield('general_Setting')"
                                href="{{ route('general_setting') }}"><i class="fas fa-tools"></i>General Setting</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link @yield('user_setting')"
                                href="{{ route('user_setting') }}"><i class="fas fa-user-cog"></i>User Setting</a></li>
                        <li class="nav-item"> <a class="nav-link @yield('product_setting')"
                                href="{{ route('product_setting') }}"><i class="fas fa-wrench"></i>Product Setting</a>
                        </li>

                    </ul>
                </div>
            </li>
            {{-- REPORT  --}}
            <li class="nav-item">
                <a class="nav-link " data-bs-toggle="collapse" href="#ui-basic-2" aria-expanded="false"
                    aria-controls="ui-basic-1">
                    <i class="fa-solid fa-flag"></i>
                    <span class="menu-title">Report</span>
                </a>
                <div class="collapse" id="ui-basic-2">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link @yield('orderrecord')"
                                href="{{ route('order_record_quantity') }}"><i
                                    class="fa-solid fa-rectangle-list"></i>Order Record</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link @yield('salerecord')"
                                href="{{ route('sale_record_quantity') }}"><i class="fa-solid fa-table-list"></i>Sale
                                Record</a>
                        </li>


                    </ul>
                </div>
            </li>

            @elseif (Auth::user()->role == 2)
                <a href="{{ route('dashboard_sale') }}" class="nav-item nav-link @yield('dashboard')"><i
                        class="fa fa-tachometer-alt me-2"></i>Dashboard</a>

                {{-- TODO: PRODUCT --}}
                <a href="{{ route('sale_sale') }}" class="nav-item nav-link @yield('sale')"><i
                        class="fa-solid fa-cart-shopping"></i>Directly Buy</a>
                <a href="{{ route('productcategory_index_sale') }}" class="nav-item nav-link @yield('productcategory')"><i
                        class="fas fa-th-list"></i>Category</a>
                <a href="{{ route('productbrand_index_sale') }}" class="nav-item nav-link @yield('productbrand')"><i
                        class="fa-solid fa-b"></i>Brand</a>
                <a href="{{ route('product_index_sale') }}" class="nav-item nav-link @yield('product')"><i
                        class="fa-brands fa-product-hunt"></i>Product</a>
                {{-- Stock Product --}}
                <a href="{{ route('renewstockproduct_sale') }}" class="nav-item nav-link @yield('renewstockproduct')"><i
                        class="fas fa-cubes"></i>Renew Stock</a>
                <a href="{{ route('addstockproduct_sale') }}" class="nav-item nav-link @yield('addstockproduct')"><i
                        class="far fa-calendar-plus"></i>Add Stock</a>
                <a href="{{ route('slider_index_sale') }}" class="nav-item nav-link @yield('slider')"><i
                        class="fa-brands fa-product-hunt"></i>Slider</a>
                {{-- Product Tracking --}}
                <a href="{{ route('producttracking_index_sale') }}" class="nav-item nav-link @yield('producttracking')"><i
                        class="fas fa-map"></i> Product Tracking</a>
            @endif
        </div>
    </nav>
</div>
