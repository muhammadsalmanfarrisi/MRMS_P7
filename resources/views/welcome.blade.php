<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('images/image.png') }}">
    <title>SPINDO P-WARE P7</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1c1c1c, #3a3a3a);
            color: #fff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .background-animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: linear-gradient(270deg, #ff0000, #ff7300, #ffeb00, #47ff00, #00ffee, #0048ff, #7a00ff, #ff00aa);
            background-size: 1600% 1600%;
            animation: gradientShift 10s ease infinite;
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .container {
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .brand-logo {
            font-size: 3rem;
            font-weight: 700;
            letter-spacing: 2px;
            color: #f8b400;
            animation: fadeIn 2s ease-in-out;
        }

        .btn-custom {
            background: #f8b400;
            color: #1c1c1c;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 50px;
            transition: all 0.3s;
            animation: slideUp 1.5s ease-out;
        }

        .btn-custom:hover {
            background: #e0a300;
            color: #fff;
        }

        .logo-container img {
            width: 100px;
            /* Adjust size as needed */
            height: auto;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .logo-container img:hover {
            transform: scale(1.1);
            /* Slight zoom effect on hover */
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: scale(0.9);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes slideUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="background-animation"></div>
    <div class="container">
        <div class="logo-container mb-4">
            <a href="/">
                <img src="{{ asset('images/image.png') }}" alt="Logo" style="width: 300px;">
            </a>
        </div>
        <h1 class="brand-logo">SPINDO MRMS P7</h1>
        <p class="lead">MAINTENANCE REPORTING MANAGEMENT SYSTEM SPINDO PLANT 7</p>
        @if (Route::has('login'))
            <div class="mt-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-custom">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-custom">Masuk</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-light ms-2">Daftar</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</body>

</html>
