<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Livewire\Traits\DisparadorAlerta;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    use DisparadorAlerta;

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        if (!Auth::user()->habilitado) {
            Auth::logout();
            $this->alertaAtencao(__('messages.account_disabled'));
            return redirect()->route('login');
        }

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function loginWithDefaultUser(): RedirectResponse
    {
        // Defina as credenciais do usuário padrão
        $defaultCredentials = [
            'email' => 'admin@email.com',
            'password' => '1a2s3d4f',
        ];

        // Tente autenticar o usuário com as credenciais padrão
        if (Auth::attempt($defaultCredentials)) {
            request()->session()->regenerate(); // Regenera a sessão após autenticar
            return redirect()->intended(RouteServiceProvider::HOME); // Redireciona ao destino padrão
        }

        // Se as credenciais não forem válidas
        return redirect()->route('login')->withErrors(['default' => 'Não foi possível realizar o login com o usuário padrão.']);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
