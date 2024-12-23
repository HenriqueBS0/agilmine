<?php

namespace App\Http\Middleware;

use App\Livewire\Traits\DisparadorAlerta;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    use DisparadorAlerta;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && !Auth::user()->habilitado) {
            Auth::logout(); // Desloga o usuário
            $this->alertaAtencao(__('messages.account_disabled'));
            return redirect()->route('login');
        }

        return $next($request);
    }
}
