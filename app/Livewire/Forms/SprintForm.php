<?php

namespace App\Livewire\Forms;

use App\Models\Sprint;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SprintForm extends Form
{
    public ?Sprint $sprint;

    #[Validate('required|max:100')]
    public string $nome = '';

    #[Validate('required')]
    public string $resumo = '';

    #[Validate('required|date_format:Y-m-d')]
    public string $data_inicio;

    #[Validate('required|date_format:Y-m-d|after_or_equal:data_inicio')]
    public string $data_fim;

    #[Validate('boolean')]
    public bool $gera_release = false;

    #[Validate('array')]
    public array $tarefas = [];

    #[Validate('required|integer')]
    public int $project_id;

    public function setSprint(Sprint $sprint, bool $setAtributos = true)
    {
        $this->sprint = $sprint;

        $this->project_id = $sprint->project_id;

        if (!$setAtributos) {
            return;
        }

        $this->nome = $sprint->nome;
        $this->resumo = $sprint->resumo;
        $this->data_inicio = $sprint->data_inicio->format('Y-m-d');
        $this->data_fim = $sprint->data_fim->format('Y-m-d');
        $this->gera_release = $sprint->gera_release;
        $this->tarefas = $sprint->tarefas;
    }

    public function store()
    {
        $this->validate();

        $this->sprint = Sprint::create($this->only([
            'nome',
            'resumo',
            'data_inicio',
            'data_fim',
            'gera_release',
            'tarefas',
            'project_id'
        ]));
    }

    public function update()
    {
        $this->validate();

        $this->sprint->update(
            $this->all()
        );
    }

    public function validationAttributes()
    {
        return [
            'nome' => 'Nome',
            'resumo' => 'Resumo',
            'data_inicio' => 'Data Inicio',
            'data_fim' => 'Data Fim',
            'gera_release' => 'Gera Release',
        ];
    }
}
