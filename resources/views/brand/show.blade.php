@extends('layout.user.app')

<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
<link rel="stylesheet" href="{{ asset('style/button.css') }}">
<link rel="stylesheet" href="{{ asset('style/footer.css') }}">
<link rel="stylesheet" href="{{ asset('navbar/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('navbar/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('navbar/style.css') }}">
<link rel="stylesheet" href="{{ asset('navbar/fonts/icomoon/style.css') }}">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('style/body.css') }}">

@livewireStyles
<div>
    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>


    <header style="border-radius:20px" class="site-navbar js-sticky-header site-navbar-target" role="banner">

        <div class="container">
            <div class="row align-items-center position-relative">


                <div class="site-logo">
                    <a href="{{ route('home') }}" class="text-black"><span class="text-primary">BTB PC</a>
                </div>

                <div class="col-12">
                    <nav class="site-navigation text-right ml-auto " role="navigation">

                        <ul class="site-menu main-menu js-clone-nav ml-auto d-none d-lg-block">
                            <li><a href="{{ route('home') }}" class="nav-link">Home</a></li>



                            <li class="has-children">
                                <a href="{{ route('home') }}" class="nav-link active">Brand</a>
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
                                <li><a class="nav-link" href="{{ route('view_productcart') }}"><i
                                            class="fas fa-truck"></i>Cart (@livewire('pages.user.productcart.product-cart-count'))</a></li>
                                <li><a class="nav-link" href="{{ route('logout') }}"><i class="fas fa-truck"></i>Log
                                        Out</a>
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
    <h1 style="margin-top: 20px;">{{ $brand->brand }}</h1>
    <div class="row pb-5 mb-4">

        @foreach ($sortedProducts as $categoryName => $products)
            <div class="col-12">
                <h2 style=" padding: 1em;">{{ $categoryName }}</h2>
            </div>


            @foreach ($products as $product)
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <!-- Card-->
                    <div class="card rounded border-0" style="margin-bottom:20px">
                        <a href="{{ route('viewdetailproduct', ['model' => $product->model]) }}">
                            <div class="card-body p-4">
                                @if ($product->quantity > 1)
                                    <label class="stock bg-success text-white p-1 rounded-3">In Stock</label>
                                @else
                                    <label class="stock bg-danger text-white p-1 rounded-3">Out of Stock</label>
                                @endif
                                <img src="{{ asset('storage/' . $product->image) }}" alt=""
                                    class="img-fluid d-block mx-auto mb-3">
                                <hr>
                                <p class="text-dark mb-0"><strong>CATEGORY:</strong> {{ $categoryName }}</p>
                                <p class="text-dark mb-0"><strong>BRAND:</strong> {{ $product->productbrand->brand }}
                                </p>
                                <p class="text-dark mb-0"><strong>MODEL:</strong> {{ $product->model }}</p>
                                <p class="text-dark mb-0"><strong>Price:</strong> {{ $product->price }}$</p>
                                <p class="text-dark mb-0"><strong>CPU:</strong> {{ $product->cpu }}</p>
                                <p class="text-dark mb-0"><strong>GPU:</strong> {{ $product->gpu }}</p>
                                <p class="text-dark mb-0"><strong>RAM:</strong>{{ $product->ram }}</p>
                                <p class="text-dark mb-0s"><strong>WARRANTY YEARS:
                                    </strong>{{ $product->official_warranty }}</p>
                                <div class="d-flex justify-content-center mt-3">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <a href="{{ route('viewdetailproduct', ['model' => $product->model]) }}"
                                                class="btn btn-md">
                                                <span>View_Detail</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        @endforeach

    </div>
</div>
<script src="/jsnavbar/jquery-3.3.1.min.js"></script>
<script src="/jsnavbar/popper.min.js"></script>
<script src="/jsnavbar/bootstrap.min.js"></script>
<script src="/jsnavbar/jquery.sticky.js"></script>
<script src="/jsnavbar/main.js"></script>
@livewireScripts
