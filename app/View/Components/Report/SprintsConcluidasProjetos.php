<?php

namespace App\View\Components\Report;

use App\Models\Projeto;
use App\Services\Metricas\MetricasProjeto;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SprintsConcluidasProjetos extends Component
{
    public $valor;

    public $legenda = "Sprints Concluídas";

    public $icone = "check-circle";

    /**
     * Create a new component instance.
     */
    public function __construct(array $tarefas, MetricasProjeto $metrica, array $projetos = [])
    {
        $this->valor = $metrica->sprintsProjetosConcluidas($projetos, $tarefas);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.report.indicador-icon');
    }
}
