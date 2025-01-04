<?php

namespace App\View\Components\Projeto\Report;

use App\Models\Projeto;
use App\Services\ProjetoService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Metricas extends Component
{
    public array $sprints = [];

    /**
     * Create a new component instance.
     */
    public function __construct(public Projeto $projeto, public array $tarefas, ProjetoService $projetoService)
    {
        $this->sprints = $projetoService->getSprintsMetricas($projeto)->get()->all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.projeto.report.metricas');
    }
}
