<!doctype html>
<html lang="en">

<head>
    <title>{{ setting('title_name') }}</title>
    {{-- <link rel="icon" href="{{ asset('storage/' . \App\Models\Setting::first()->image) }}" type="image/x-icon"> --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
    <link rel="stylesheet" href="{{ asset('style/custom.css') }}">
    
    <style>
        body {
            margin-top: 10px;
            background: linear-gradient(to bottom, rgb(232, 244, 251), rgb(251, 221, 235));
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .welcometitle {
            text-align: center;
            margin-top: 30px;
            background-image: linear-gradient(43deg, #f8bd6f 46%, #f3e416 100%);
            -webkit-background-clip: text;
            color: transparent;
            animation: rotation 10s linear infinite;

        }

        @keyframes rotation {
            0% {
                transform: rotate(0);

            }

            10% {
                transform: rotate(-10deg);

            }

            20% {
                transform: rotate(10deg);

            }

            30% {
                transform: rotate(-10deg);

            }

            40% {
                transform: rotate(10deg);

            }

            50% {
                transform: rotate(-10deg);

            }

            60% {
                transform: rotate(10deg);

            }

            70% {
                transform: rotate(-10deg);

            }

            80% {
                transform: rotate(10deg);

            }

            90% {
                transform: rotate(-10deg);

            }

            100% {
                transform: rotate(10deg);

            }
        }

        @keyframes moveIn {
            0% {
                transform: translateX(-300px);
            }

            100% {
                transform: translateX(50px);

            }

        }

        .fade-in {
            margin-top: 100px;
            text-align: center;
            font-family: cursive;
            font-size: 20px;
            animation: moveIn 2s ease-in-out forwards;

        }
    </style>
    @livewireStyles

</head>

<body>
    <!--Content Start -->
    <!-- resources/views/home.blade.php -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- Rest of your home view content -->

    <div>
        @yield('content')
    </div>
    <!--Content End -->


    <!--Footer Start-->
    @include('layout.user.footer')
    <!--Footer End-->


    <script src="/jsnavbar/jquery-3.3.1.min.js"></script>
    <script src="/jsnavbar/popper.min.js"></script>
    <script src="/jsnavbar/bootstrap.min.js"></script>
    <script src="/jsnavbar/jquery.sticky.js"></script>
    <script src="/jsnavbar/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @livewireScripts
</body>

</html>
