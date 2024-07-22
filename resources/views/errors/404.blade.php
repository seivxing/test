<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('notfound/stylenotfound.css') }}">
    <title>Document</title>
    <style>
        body {
            padding: 4rem;
        }

        .container {
            position: absolute;
            top: 320px;
            left: 720px;
            justify-content: center;
            align-items: center;
            height: 30vh;

            @media (max-width: 1621px) {
                display: none;
            }



            /* Adjust as needed */
        }
    </style>
</head>

<body>

    <div id="notfound">
        <div class="notfound" style="margin-bottom: 100px;">
            <div class="notfound-404">
                <h1>404</h1>
            </div>
            <h2>We are sorry, Page not found!</h2>
            <p>The page you are looking for might have been removed had its name changed or is temporarily unavailable.
            </p>
            <a href="{{ route('home') }}">Back To Homepage</a>
        </div>

    </div>
    <div class="container">
        <iframe src="{{ asset('giphy (1).gif') }}" width="480" height="480" frameBorder="0" class="giphy-embed"
            allowFullScreen></iframe>
    </div>
    <!-- JavaScript for redirection -->
    <script>
        setTimeout(function() {
            window.location.href = "/";
        }, 3000); // 3000 milliseconds (3 seconds)
    </script>
</body>

</html>
