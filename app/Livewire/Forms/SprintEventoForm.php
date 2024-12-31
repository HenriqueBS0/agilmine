<?php

namespace App\Livewire\Forms;

use App\Models\Enums\EventoTipo;
use App\Models\SprintEvento;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SprintEventoForm extends Form
{
    public ?SprintEvento $evento;

    #[Validate('required|integer')]
    public int $sprint_id;

    #[Validate('required|integer|in:1,2,3,4,5')]
    public ?int $tipo;

    #[Validate('required|string')]
    public string $descricao;

    #[Validate('required|array')]
    public array $participantes = [];

    #[Validate('required|date_format:Y-m-d\TH:i')]
    public string $data_hora;

    public function setEvento(SprintEvento $evento)
    {
        $this->evento = $evento;

        $this->sprint_id = $evento->sprint->id;
        $this->tipo = $evento->tipo->value; // Obtém o valor numérico do enum
        $this->descricao = $evento->descricao;
        $this->participantes = $evento->participantes;
        $this->data_hora = $evento->data_hora->format('Y-m-d\TH:i');
    }

    public function store()
    {
        $this->validate();

        SprintEvento::create([
            'sprint_id' => $this->sprint_id,
            'tipo' => EventoTipo::from($this->tipo),
            'descricao' => $this->descricao,
            'participantes' => $this->participantes,
            'data_hora' => $this->data_hora,
        ]);
    }

    public function update()
    {
        $this->validate();

        $this->evento->update([
            'sprint_id' => $this->sprint_id,
            'tipo' => EventoTipo::from($this->tipo),
            'descricao' => $this->descricao,
            'participantes' => $this->participantes,
            'data_hora' => $this->data_hora,
        ]);
    }
}
