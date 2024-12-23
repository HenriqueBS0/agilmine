@extends('components.layouts.auth')

@section('content')
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
@endsection
