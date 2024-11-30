<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agilmine</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/scss/app.scss'])
</head>

<body class="bg-light">

    <div class="d-flex flex-column justify-content-center align-items-center min-vh-100">
        <h1 class="display-4 fw-bold text-dark mb-4">
            Agilmine
        </h1>

        <div class="d-flex gap-3">
            <a href="{{ route('login') }}" class="btn btn-primary">
                Login
            </a>
            <a href="{{ route('register') }}" class="btn btn-secondary">
                Register
            </a>
        </div>
    </div>

</body>

</html>
