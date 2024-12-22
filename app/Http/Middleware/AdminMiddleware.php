<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica se o usuário autenticado é admin
        if (auth()->check() && auth()->user()->admin) {
            return $next($request);
        }

        // Se não for admin, retorna erro 403
        abort(403, 'Ação não autorizada.');
    }
}
