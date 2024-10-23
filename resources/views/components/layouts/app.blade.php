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
    <div class="content-contaienr h-100 d-flex">
        <div class="sidebar-container bg-info col-3">
            Sidebar
        </div>
        <main class="main-content bg-success col overflow-y-scroll">
            Main
        </main>
    </div>
</body>

</html>
