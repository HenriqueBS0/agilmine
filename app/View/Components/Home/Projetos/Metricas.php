<?php

namespace App\View\Components\Home\Projetos;

use App\Services\ProjetoService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Metricas extends Component
{
    public array $tarefasProjetosMetricaHoras = [];

    /**
     * Create a new component instance.
     */
    public function __construct(public array $projetos, public array $tarefas, ProjetoService $projetoService)
    {
        $this->setTarefasProjetosMetricaHoras($tarefas, $projetos, $projetoService);
    }

    private function setTarefasProjetosMetricaHoras(array $tarefas, array $projetos, ProjetoService $projetoService)
    {
        $projetos = $projetoService->filtraProjetosMetricaHorasAtiva($projetos);

        foreach ($projetos as $projeto) {
            $this->tarefasProjetosMetricaHoras = array_merge(
                $this->tarefasProjetosMetricaHoras,
                $projetoService->filtraTarefasProjeto($projeto, $tarefas)
            );
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.home.projetos.metricas');
    }
}
