<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/scss/app.scss'])
</head>

<body class="bg-light">
    <div class="min-vh-100">
        <x-navbar>
            <x-slot:breadcrumb>
                <x-breadcrumb class="m-0">
                    <x-breadcrumb-item active>Perfil</x-breadcrumb-item>
                </x-breadcrumb>
            </x-slot:breadcrumb>
        </x-navbar>

        <!-- Page Content -->
        <main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <!-- Profile Information -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Profile Information') }}</h5>
                                <form method="post" action="{{ route('profile.update') }}">
                                    @csrf
                                    @method('patch')
                                    <div class="mb-3">
                                        <label for="name" class="form-label">{{ __('Name') }}</label>
                                        <input type="text" id="name" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', $user->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">{{ __('Email') }}</label>
                                        <input type="email" id="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email', $user->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="key_redmine" class="form-label">Key Redmine</label>
                                        <input type="text" id="key_redmine" name="key_redmine"
                                            class="form-control @error('key_redmine') is-invalid @enderror"
                                            value="{{ old('key_redmine', $user->key_redmine) }}" required>
                                        @error('key_redmine')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-secondary">{{ __('Save') }}</button>
                                </form>
                            </div>
                        </div>

                        <!-- Update Password -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Update Password') }}</h5>
                                <form method="post" action="{{ route('password.update') }}">
                                    @csrf
                                    @method('put')
                                    <div class="mb-3">
                                        <label for="current_password"
                                            class="form-label">{{ __('Current Password') }}</label>
                                        <input type="password" id="current_password" name="current_password"
                                            class="form-control @error('current_password') is-invalid @enderror"
                                            autocomplete="current-password">
                                        @error('current_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">{{ __('New Password') }}</label>
                                        <input type="password" id="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            autocomplete="new-password">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password_confirmation"
                                            class="form-label">{{ __('Confirm Password') }}</label>
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                            class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-secondary">{{ __('Save') }}</button>
                                </form>
                            </div>
                        </div>

                        <!-- Delete Account -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Delete Account') }}</h5>
                                <p class="text-danger">
                                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                                </p>

                                <!-- Botão que abre o modal -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#confirmDeletionModal">
                                    {{ __('Delete Account') }}
                                </button>
                            </div>
                        </div>

                        <!-- Modal de Confirmação -->
                        <div class="modal fade" id="confirmDeletionModal" tabindex="-1"
                            aria-labelledby="confirmDeletionModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmDeletionModalLabel">
                                            {{ __('Delete Account') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                            {{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                                        </p>
                                        <form id="deleteAccountForm" method="post"
                                            action="{{ route('profile.destroy') }}">
                                            @csrf
                                            @method('delete')
                                            <div class="mb-3">
                                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                                <input type="password" id="password" name="password"
                                                    class="form-control" placeholder="{{ __('Password') }}" required>
                                                @if ($errors->userDeletion->has('password'))
                                                    <div class="text-danger mt-1">
                                                        {{ $errors->userDeletion->first('password') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            {{ __('Cancel') }}
                                        </button>
                                        <button type="submit" form="deleteAccountForm" class="btn btn-danger">
                                            {{ __('Delete Account') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
