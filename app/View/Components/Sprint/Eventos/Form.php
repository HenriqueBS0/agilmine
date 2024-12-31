<?php

namespace App\View\Components\Sprint\Eventos;

use App\Livewire\Forms\SprintEventoForm;
use App\Models\Sprint;
use App\Services\ProjetoService;
use App\Services\SprintService;
use Closure;
use Gate;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public SprintEventoForm $form;
    public string $titulo;
    public bool $isGestor;
    public ?string $cancelar;
    public $membros;
    public $tipos;

    /**
     * Create a new component instance.
     */
    public function __construct(
        SprintEventoForm $form,
        Sprint $sprint,
        ProjetoService $projetoService,
        SprintService $sprintService,
        string $titulo,
        ?string $cancelar = null
    ) {
        $this->form = $form;
        $this->titulo = $titulo;
        $this->isGestor = Gate::allows('isGestor', $sprint);
        $this->cancelar = $cancelar;
        $this->membros = $projetoService->getMembros($sprint->projeto);
        $this->tipos = $sprintService->getTiposEventoDisponiveis($sprint);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sprint.eventos.form');
    }
}
