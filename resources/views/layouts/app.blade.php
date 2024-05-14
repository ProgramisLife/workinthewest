<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Workinthewest - Praca dla wszystkich') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Custom CSS Style -->
    <link rel="stylesheet" href="{{ asset('assets/css/shared/main.css') }}" type="text/css" />

</head>

<body class="antialiased font-family-open-sans background-light-white">
    @include('components.navbar')
    <main>
        @yield('content')
    </main>
    @include('components.footer')
</body>

</html>