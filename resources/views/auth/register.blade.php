@extends('components.layouts.auth')

@section('title', 'Resgistro - Agilmine')

@section('content')
    <div class="card shadow-sm w-100" style="max-width: 28rem;">
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <!-- Name -->
                <x-input id="name" container-class="mb-3" monitor-erro="name" name="name" type="text"
                    value="{{ old('name') }}" required autofocus autocomplete="name">
                    <x-slot:label>
                        {{ __('Name') }}
                    </x-slot:label>
                </x-input>

                <x-input id="email" container-class="mb-3" monitor-erro="email" name="email" type="email"
                    value="{{ old('email') }}" required autofocus autocomplete="username">
                    <x-slot:label>
                        {{ __('Email') }}
                    </x-slot:label>
                </x-input>

                <x-input id="password" container-class="mb-3" monitor-erro="password" name="password" type="password"
                    value="{{ old('password') }}" required autofocus autocomplete="new-password">
                    <x-slot:label>
                        {{ __('Password') }}
                    </x-slot:label>
                </x-input>

                <x-input id="password_confirmation" container-class="mb-3" monitor-erro="password_confirmation"
                    name="password_confirmation" type="password" value="{{ old('password_confirmation') }}" required
                    autofocus autocomplete="new-password">
                    <x-slot:label>
                        {{ __('Confirm Password') }}
                    </x-slot:label>
                </x-input>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('login') }}" class="text-secondary text-decoration-none">
                        {{ __('Already registered?') }}
                    </a>
                    <button type="submit" class="btn btn-secondary">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
