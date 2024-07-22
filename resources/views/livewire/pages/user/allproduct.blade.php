<style>
    .slidercarousel {
        width: 45%;
        display: flex;
        justify-content: center;
        align-content: center;
        margin: 0 auto;
        color: black !important;
        border-radius: 20px;
    }

    .slidercarousel h1 {
        color: black !important;
    }





    @media screen and (min-width:1920px) {
        .slidercarousel {
            max-width: 50%;
            display: flex;
            justify-content: center;
            align-content: center;
            margin: 0 auto;
        }
    }

    @media screen and (min-width:1670px) {
        .slidercarousel {
            max-width: 60%;
            display: flex;
            justify-content: center;
            align-content: center;
            margin: 0 auto;

        }

        h1 {
            font-size: 20px !important;
            color: black !important;
        }
    }

    @media screen and (min-width:1440px) {
        .slidercarousel {
            max-width: 60%;
            display: flex;
            justify-content: center;
            align-content: center;
            margin: 0 auto;
        }

        h1 {
            font-size: 17px !important;
            color: black !important;

        }
    }

    @media screen and (min-width: 1300px) {
        .slidercarousel {
            max-width: 70%;
            display: flex;
            justify-content: center;
            align-content: center;
            margin: 0 auto;
        }

        h1 {
            font-size: 12px !important;
            color: black !important;

        }
    }

    @media screen and (min-width:840px) {
        h1 {
            font-size: 17px !important;
            color: black !important;

        }
    }
</style>

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
                    {{-- <a href="{{ route('home') }}" class="text-black"><span class="text-primary">BTB PC</a> --}}
                </div>

                <div class="col-12">
                    <nav class="site-navigation text-right ml-auto " role="navigation">

                        <ul class="site-menu main-menu js-clone-nav ml-auto d-none d-lg-block">
                            <li><a href="{{ route('home') }}" class="nav-link active">Home</a></li>



                            <li class="has-children">
                                <a href="#" class="nav-link">Brand</a>
                                <ul class="dropdown arrow-top">
                                    @foreach ($productbrands as $productbrand)
                                        {{-- <li><a href="" class="nav-link"></a></li> --}}
                                        <li>
                                            <a class="nav-link" style="cursor: pointer"
                                                wire:click="redirectToproductbrand({{ $productbrand->id }})"value="{{ $productbrand->id }}">{{ $productbrand->brand }}</a>
                                        </li>
                                    @endforeach

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
                                            class="fas fa-truck"></i> Tracking (@livewire('pages.user.producttracking.product-tracking-count'))</a></li>
                                <li><a class="nav-link" href="{{ route('view_productcart') }}"><i
                                    class="fas fa-shopping-cart"></i> Cart (@livewire('pages.user.productcart.product-cart-count'))</a></li>
                                <li><a class="nav-link" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Log Out</a>
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
    <div>
        <h1 class="welcometitle font-weight-bold mb-2" style="font-size: 50px !important ">
            Welcome to our shop </h1>
        {{-- <h1 class="font-weight-bold mb-2">Welcome to our shop</h1> --}}
        <h2 class="font-italic text-muted mb-4 fade-in">Welcome to a world of effortless shopping, where your desires
            meet convenience at every click.</h2>



        <div id="carouselExampleCaptions" class=" slidercarousel carousel slide mt-4 ">

            <div class="carousel-inner mb-4">
                @foreach ($sliders as $key => $sliderItem)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        @if ($sliderItem->image)
                            <img src="{{ asset("$sliderItem->image") }}" class="d-block w-100" alt="...">
                        @endif

                        <div class="carousel-caption d-none d-md-block">
                            <div class="custom-carousel-content">
                                {{-- <h1>
                                    {{ $sliderItem->title }}
                                </h1>
                                <p>
                                    {{ $sliderItem->description }}
                                </p> --}}
                                {{-- <div>
                                    <a href="#" class="btn btn-slider">
                                        Get Now
                                    </a>
                                </div> --}}
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>


        <div class="row pb-5 mb-4">

            @foreach ($sortedProducts as $categoryName => $products)
                <div class="col-12">
                    <h2 style=" padding: 1em;">{{ $categoryName }}</h2>
                </div>

                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">

                        <!-- Card-->

                        <div style="border-radius: 25px !important;margin-bottom:100px !important"
                            class="card rounded border-0">
                            <a href="{{ route('viewdetailproduct', ['model' => $product->model]) }}">
                                <div style="border-radius: 20px" class="card-body  p-4">
                                    @if ($product->quantity >= 1)
                                        <label class="stock bg-success text-white p-1 rounded-3">In Stock</label>
                                    @else
                                        <label class="stock bg-danger text-white p-1 rounded-3">Out of Stock</label>
                                    @endif

                                    <img src="{{ asset('storage/' . $product->image) }}" alt=""
                                        class="img-fluid d-block mx-auto mb-3">
                                    <hr>
                                    <p class="text-dark mb-0"
                                        @if ($product->productcategory->category_name === null) style="display: none" @endif>
                                        <strong>CATEGORY:</strong> {{ $product->productcategory->category_name }}
                                    </p>
                                    <p class="text-dark mb-0"
                                        @if ($product->productbrand->brand === null) style="display: none" @endif>
                                        <strong>BRAND:</strong> {{ $product->productbrand->brand }}
                                    </p>
                                    <p class="text-dark mb-0"
                                        @if ($product->model === null) style="display: none" @endif>
                                        <strong>MODEL:</strong> {{ $product->model }}
                                    </p>
                                    <p class="text-dark mb-0"
                                        @if ($product->price === null) style="display: none" @endif>
                                        <strong>Price:</strong> {{ $product->price }}$
                                    </p>
                                    <p class="text-dark mb-0"
                                        @if ($product->cpu === null) style="display: none" @endif>
                                        <strong>CPU:</strong>
                                        {{ $product->cpu }}
                                    </p>
                                    <p class="text-dark mb-0"
                                        @if ($product->gpu === null) style="display: none" @endif>
                                        <strong>GPU:</strong>
                                        {{ $product->gpu }}
                                    </p>
                                    <p class="text-dark mb-0"
                                        @if ($product->ram === null) style="display: none" @endif>
                                        <strong>RAM:</strong>{{ $product->ram }}
                                    </p>
                                    <p class="text-dark mb-0"
                                        @if ($product->official_warranty === null) style="display: none" @endif><strong>WARRANTY
                                            YEARS:</strong>{{ $product->official_warranty }}</p>

                                    <div class="d-flex justify-content-center mt-3">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <a href="{{ route('viewdetailproduct', ['model' => $product->model]) }}"
                                                    class="btn btn-md">
                                                    <span style="width:100% !important">View_Detail </span>
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
