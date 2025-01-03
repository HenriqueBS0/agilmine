<?php

namespace App\View\Components\Sprint\Report;

use App\Models\Enums\EventoTipo;
use App\Models\Sprint;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Eventos extends Component
{

    public $eventos;

    private $membros = [];

    /**
     * Create a new component instance.
     */
    public function __construct(Sprint $sprint, array $membros)
    {
        $this->setEventos($sprint);
        $this->membros = $membros;
    }

    private function setEventos(Sprint $sprint)
    {
        $tipos = [
            EventoTipo::PLANEJAMENTO->value,
            EventoTipo::REVISAO->value,
            EventoTipo::RETROSPECTIVA->value
        ];

        $this->eventos = $sprint->eventos()
            ->whereIn('tipo', $tipos)
            ->orderByRaw("FIELD(tipo, ?, ?, ?)", $tipos)
            ->get();
    }

    public function getParticipantes($ids)
    {
        $participantes = [];

        foreach ($ids as $id) {
            if (isset($this->membros[$id])) {
                $participantes[] = $this->membros[$id]->getUsuario()->getNome();
            }
        }

        return implode(', ', $participantes) . '.';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sprint.report.eventos');
    }
}
