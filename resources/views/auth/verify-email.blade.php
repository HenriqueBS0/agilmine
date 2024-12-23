@extends('components.layouts.auth')

@section('title', 'Resgistro - Agilmine')

@section('content')
    <div class="card shadow-sm w-100" style="max-width: 28rem;">
        <div class="card-body">
            <p class="text-muted mb-4">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success mb-3">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif

            <!-- Resend Verification Email -->
            <form method="POST" action="{{ route('verification.send') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-primary">
                    {{ __('Resend Verification Email') }}
                </button>
            </form>

            <!-- Log Out -->
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-secondary">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
@endsection
