<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ setting('title_name') }}</title>

    <link rel="icon" href="{{ asset('storage/' . \App\Models\Setting::first()->image) }}" type="image/x-icon">


    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    {{-- <link href="img/favicon.ico" rel="icon"> --}}

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('bs5/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bs5/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('bs5/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('bs5/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @livewireStyles
    <style>
        @media print {
        #tableproduct th:last-child,
        #tableproduct td:last-child {
            display: none;
        }
    }
    /* Renew Product Component */
    @media print{
        #tablerenewstock th:last-child,
        #tablerenewstock td:last-child{
            display:none;
        }
    }

    @media print{
        #tableaddnewstock th:last-child,
        #tableaddnewstock td:last-child{
            display:none;
        }
    }

    @media print{
        #tableproduct th:last-child,
        #tableproduct td:last-child{
            display:none !important;
        }

    }
    @media print{
        #tablerenewstock: th:last-child,
        #tablerenewstock: td:last-child{
            display:none;
        }
    }
    @media print {
    #tabletracking th:last-child,
    #tabletracking td:last-child {
        display: none !important; /* Use !important to ensure the styles override any other conflicting styles */
    }
}

    </style>
</head>

<body>

    <div class="position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        @include('layout.admin.sidebar')
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            @include('layout.admin.navbar')
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                @yield('content')
            </div>
            <!-- Sale & Revenue End -->

            <!-- Footer Start -->
            @include('layout.admin.footer')
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        {{-- <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a> --}}
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('bs5/lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('bs5/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('bs5/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('bs5/lib/owlcarousel/owl.carousel.min.js') }} "></script>
    <script src="{{ asset('bs5/lib/tempusdominus/js/moment.min.js') }} "></script>
    <script src="{{ asset('bs5/lib/tempusdominus/js/moment-timezone.min.js') }} "></script>
    <script src="{{ asset('bs5/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }} "></script>

    <!-- Template Javascript -->
    <script src="{{ asset('bs5/js/main.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.class-room-assign').select2({
                dropdownParent: $('#assignsubject'),
                placeholder: 'Select Subject',
            });

        });
    </script>

    @yield('script')
    @livewireScripts
    @stack('script')

</body>

</html>
