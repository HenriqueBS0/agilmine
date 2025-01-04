<?php

namespace App\View\Components\Report;

use App\Models\Projeto;
use App\Services\Metricas\MetricasProjeto;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SprintsEmAndamentoProjeto extends Component
{
    public $valor;

    public $legenda = "Sprints Em Andamento";

    public $icone = "flag";

    /**
     * Create a new component instance.
     */
    public function __construct(Projeto $projeto, array $tarefas, MetricasProjeto $metrica)
    {
        $this->valor = $metrica->setProjeto($projeto)->setTarefas($tarefas)->numeroSprintsEmAndamento();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.report.indicador-icon');
    }
}
