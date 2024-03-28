<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<style>
    body {
        font-family: 'Open Sans', sans-serif;
        background-color: #f6f7f9;
    }
</style>

<body class="antialiased">
    <header>
        @include('components.navbar')
    </header>
    <main class="my-5">
        @yield('content')
    </main>
    <footer>
        @include('components.footer')
    </footer>
</body>

</html>