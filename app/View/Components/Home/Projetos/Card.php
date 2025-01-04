<?php

namespace App\View\Components\Home\Projetos;

use App\Models\Projeto;
use App\Services\ProjetoService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public array $tarefas;

    /**
     * Create a new component instance.
     */
    public function __construct(public Projeto $projeto, array $tarefas, ProjetoService $projetoService)
    {
        $this->tarefas = $projetoService->filtraTarefasProjeto($projeto, $tarefas);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.home.projetos.card');
    }
}
