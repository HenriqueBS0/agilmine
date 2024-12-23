<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Agilmine')</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/scss/app.scss'])
</head>

<body class="bg-light text-dark">
    <div class="min-vh-100 d-flex flex-column">
        <!-- Conteúdo Dinâmico -->
        <main class="flex-grow-1 d-flex justify-content-center align-items-center">
            @yield('content')
        </main>
    </div>
</body>

</html>
