<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset("asset/fontawesome-free/css/all.min.css")}}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead

    <style>
        .header-scroll {
            position: fixed;
            background: white;
            border: solid 1px #ddd;
            animation: headerAnimate 0.4s both;
        }

        @keyframes headerAnimate {
            0% {
                transform: translateY(10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .a-dark {
            color: black !important;
        }

        .a-white {
            color: white;
        }
    </style>

</head>

<body class="font-sans antialiased">
    @inertia

    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
