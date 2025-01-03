<?php

namespace App\Http\Middleware;

use App\Contracts\FetchRedmineInterface;
use App\Livewire\Traits\DisparadorAlerta;
use App\Services\ImportadorProjeto;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SyncRedmineProjectData
{
    use DisparadorAlerta;

    public function __construct(
        private ImportadorProjeto $importador,
        private FetchRedmineInterface $fetchRedmine
    ) {

    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $sprint = $request->route('sprint', false);

        $projeto = $sprint
            ? $sprint->projeto
            : $request->route('projeto', false);

        try {

            $projetos = $projeto
                ? [$this->fetchRedmine->projeto($projeto->id)]
                : $this->fetchRedmine->projetos();

            foreach ($projetos as $projeto) {
                $this->importador->importar($projeto);
            }

        } catch (\Throwable $th) {
            $this->alertaPerigo($th->getMessage());
        } finally {
            return $next($request);
        }
    }
}
