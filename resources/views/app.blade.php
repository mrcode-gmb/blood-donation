<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('asset/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/boxicons/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/style.css') }}">

    <!-- Scripts -->
    @routes
    @vite('resources/js/app.js') <!-- Updated entry file for Vue -->
    @vite(['resources/js/Pages/' . $page['component'] . '.vue']) <!-- Updated for Vue components -->
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia
</body>

<script src="https://js.paystack.co/v1/inline.js"></script>

</html>
