<?php

namespace App\View\Components\Projeto\Report;

use App\Models\Projeto;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Geral extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Projeto $projeto, public array $tarefas)
    {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.projeto.report.geral');
    }
}
