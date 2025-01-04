<?php

namespace App\View\Components\Report;

use App\Models\Projeto;
use App\Services\ProjetoService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CronogramaReleases extends Component
{
    public array $releases;

    /**
     * Create a new component instance.
     */
    public function __construct(Projeto $projeto, ProjetoService $projetoService)
    {
        $this->releases = $projetoService->getSprintsMetricas($projeto)->where('gera_release', true)->get()->all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.report.cronograma-releases');
    }
}
