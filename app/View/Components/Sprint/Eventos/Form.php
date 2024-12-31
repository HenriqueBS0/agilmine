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
    public bool $disabilitado;
    public ?string $cancelar;
    public ?string $voltar;
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
        ?string $cancelar = null,
        ?string $voltar = null,
        bool $disabilitado = false,
    ) {
        $this->form = $form;
        $this->disabilitado = $disabilitado;
        $this->cancelar = $cancelar;
        $this->voltar = $voltar;
        $this->membros = $projetoService->getMembros($sprint->projeto);
        $this->tipos = $sprintService->getTiposEventoDisponiveis($sprint, $form->evento ?? null);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sprint.eventos.form');
    }
}
