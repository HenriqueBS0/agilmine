<?php

namespace App\Livewire\Forms;

use App\Models\Sprint;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SprintForm extends Form
{
    public ?Sprint $sprint;

    #[Validate('required|max:100')]
    public string $nome;

    #[Validate('required')]
    public string $resumo;

    #[Validate('required|date_format:Y-m-d')]
    public string $data_inicio;

    #[Validate('required|date_format:Y-m-d|after:data_inicio')]
    public string $data_fim;

    #[Validate('boolean')]
    public bool $gera_release = false;

    #[Validate('required|integer')]
    public int $project_id;

    #[Validate('integer|nullable')]
    public ?int $versao = null;

    #[Validate('required_if:gera_release,true|nullable|string')]
    public ?string $resumo_release;

    public function setSprint(Sprint $sprint)
    {
        $this->sprint = $sprint;

        $this->project_id = $sprint->project_id;
        $this->nome = $sprint->nome;
        $this->resumo = $sprint->resumo;
        $this->data_inicio = $sprint->data_inicio->format('Y-m-d');
        $this->data_fim = $sprint->data_fim->format('Y-m-d');
        $this->gera_release = $sprint->gera_release;
        $this->versao = $sprint->versao;
        $this->resumo_release = $sprint->resumo_release;
    }

    public function store()
    {
        $this->validate();

        if (!$this->gera_release) {
            $this->resumo_release = null;
        }

        Sprint::create($this->only([
            'project_id',
            'nome',
            'resumo',
            'data_inicio',
            'data_fim',
            'gera_release',
            'versao',
            'resumo_release'
        ]));
    }

    public function update()
    {
        $this->validate();

        $this->sprint->update($this->all());
    }
}
