<?php

namespace App\View\Components\Sprint\Report;

use App\Models\Sprint;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Metricas extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Sprint $sprint,
        public array $tarefas
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sprint.report.metricas');
    }
}
