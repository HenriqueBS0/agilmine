<?php

namespace App\Http\Middleware;

use App\Livewire\Traits\DisparadorAlerta;
use App\Services\ApiRedmine\ApiRedmine;
use App\Services\ApiRedmine\Entidades\Projeto;
use App\Services\ProjetoService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SyncRedmineProjectData
{
    use DisparadorAlerta;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $projeto = $request->route('projeto', false);
            $projetos = $projeto
                ? [ApiRedmine::listar(Projeto::parametroFind($projeto->id))->dados()]
                : ApiRedmine::listar(Projeto::parametroListar(100))->dados();

            (new ProjetoService)->atualizarProjetos($projetos);
        } catch (\Throwable $th) {
            $this->alertaPerigo($th->getMessage());
        } finally {
            return $next($request);
        }
    }
}
