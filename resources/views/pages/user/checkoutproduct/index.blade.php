@extends('layout.user.app')

@section('content')
    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>


    <header class="site-navbar js-sticky-header site-navbar-target" style="border-radius: 20px" role="banner">

        <div class="container">
            <div class="row align-items-center position-relative">


                <div class="site-logo">
                    <a href="index.html" class="text-black"><span class="text-primary">Brand</a>
                </div>

                <div class="col-12">
                    <nav class="site-navigation text-right ml-auto " role="navigation">

                        <ul class="site-menu main-menu js-clone-nav ml-auto d-none d-lg-block">
                            <li><a href="#home-section" class="nav-link">Home</a></li>
                            <li><a href="#services-section" class="nav-link">Services</a></li>


                            <li class="has-children">
                                <a href="#about-section" class="nav-link">Brand</a>
                                <ul class="dropdown arrow-top">
                                    @foreach ($brandnames as $brandname)
                                        {{-- <li><a href="" class="nav-link"></a></li> --}}
                                        <li><a class="nav-link"
                                                href="{{ route('brand.show', ['brand' => $brandname->brand]) }}">{{ $brandname->brand }}</a>
                                        </li>
                                    @endforeach
                                    {{-- <li><a  class="nav-link"
                                    href="{{ route('brand.show', ['brand' => $brandname->brand]) }}">{{ $brandname->brand }}</a>
                                </li> --}}
                                </ul>
                            </li>

                            {{-- GUEST --}}
                            @guest
                                @if (Route::has('login'))
                                    <li><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                                @endif
                                @if (Route::has('register'))
                                    <li><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                                @endif
                            @endguest

                            @auth
                                <li><a class="nav-link" href="{{ route('tracking_product') }}"><i
                                            class="fas fa-truck"></i>Tracking (@livewire('pages.user.producttracking.product-tracking-count'))</a></li>
                                <li><a class="nav-link" href="{{ route('view_productcart') }}"><i class="fas fa-truck"></i>Cart
                                        (@livewire('pages.user.productcart.product-cart-count'))</a></li>
                                <li><a class="nav-link" href="{{ route('logout') }}"><i class="fas fa-truck"></i>Log Out</a>
                                </li>
                            @endauth




                        </ul>

                    </nav>

                </div>

                <div class="toggle-button d-inline-block d-lg-none"><a href="#"
                        class="site-menu-toggle py-5 js-menu-toggle text-black"><span class="icon-menu h3"></span></a>
                </div>

            </div>
        </div>

    </header>

    <livewire:pages.user.checkoutproduct.check-out-component />
@endsection
