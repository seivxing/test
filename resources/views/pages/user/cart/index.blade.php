@extends('layout.user.app')

@section('content')

<section class="ftco-section">
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">BTB PC</a>
            <form action="#" class="searchform order-sm-start order-lg-last">
                <div class="form-group d-flex">
                    <input type="text" class="form-control pl-3" placeholder="Search">
                    <button type="submit" placeholder="" class="form-control search"><span
                            class="fa fa-search"></span></button>
                </div>
            </form>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav m-auto">
                    <li class="nav-item active"><a href="#" class="nav-link">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Brand</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">

                            @foreach ($categoryname as $categoryname)
                                <a class="dropdown-item"
                                    href="{{ route('category.show', ['category' => $categoryname->category_name]) }}">
                                    {{ $categoryname->category_name }}
                                </a>
                            @endforeach
                        </div>

                    </li>

                </ul>



            </div>
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item mr-3">
                                    <a href="{{ route('login') }}" class="nav-item">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="nav-item">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('tracking.show') }}">
                                    <i class="fas fa-truck"></i>Tracking (@livewire('tracking-count'))
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('view_cart') }}">
                                    <i class="fas fa-shopping-cart"></i>Cart (<livewire:pages.user.cart.cart-count />)
                                </a>
                            </li>
                        </ul>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown04">
                                        <a class="dropdown-item" href="{{ route('logout') }}" class="dropdown-item">Log Out</a>

                            </div>

                        </li>
                        @endguest
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- END nav -->
</section>

    <livewire:pages.user.cart.cart-show />

@endsection
