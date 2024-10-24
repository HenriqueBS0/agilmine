<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Agilmine' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="d-flex flex-column vh-100">
    <div class="nav-container">{{ $navbar }}</div>
    <div class="content-container d-flex h-100 overflow-y-auto">
        <div class="sidebar-container col-3">
            {{ $sidebar }}
        </div>
        <main class="main-content col overflow-y-scroll">
            {{ $slot }}
        </main>
    </div>
</body>

</html>
