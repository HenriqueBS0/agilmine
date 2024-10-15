<?php

namespace App\Livewire\Forms;

use App\Models\Sprint;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SprintForm extends Form
{
    public ?Sprint $sprint;

    public ?int $project_id;
    public ?string $nome;

    public ?string $data_inicio;

    public ?string $data_fim;

    public array $tarefas_id = [];

    public function setSprint(Sprint $sprint)
    {
        $this->sprint = $sprint;
        $this->project_id = $sprint->project_id;
        $this->nome = $sprint->nome;
        $this->data_inicio = $sprint->data_inicio;
        $this->data_fim = $sprint->data_fim;
        $this->tarefas_id = $sprint->tarefas_id;
    }

    public function rules()
    {
        return [
            'nome' => [
                'required',
            ],
            'data_inicio' => [
                'required'
            ],
            'data_fim' => [
                'required'
            ],
            'tarefas_id' => [
                'required'
            ],
            'project_id' => [
                'required'
            ]
        ];
    }

    public function criar()
    {
        $this->validate();

        Sprint::create($this->all());
    }

    public function alterar()
    {
        $this->validate();

        $this->sprint->update($this->all());
    }
}
