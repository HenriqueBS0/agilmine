<?php

namespace App\View\Components\Report;

use App\Models\Projeto;
use App\Services\ProjetoService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CronogramaSprints extends Component
{
    public array $sprints;

    /**
     * Create a new component instance.
     */
    public function __construct(Projeto $projeto, ProjetoService $projetoService)
    {
        $this->sprints = $projetoService->getSprintsMetricas($projeto)->get()->all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.report.cronograma-sprints');
    }
}
