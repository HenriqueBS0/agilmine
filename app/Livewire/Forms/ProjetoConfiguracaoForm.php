<?php

namespace App\Livewire\Forms;

use App\Models\ProjetoConfiguracao;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProjetoConfiguracaoForm extends Form
{
    #[Validate('boolean')]
    public bool $metrica_usuario = false;

    #[Validate('boolean')]
    public bool $metrica_horas = false;

    #[Validate('boolean')]
    public bool $metrica_story_points = false;

    #[Validate('regex:/^#[0-9a-fA-F]{6}$/')]
    public string $cor_sprint_andamento = '#000000';

    #[Validate('regex:/^#[0-9a-fA-F]{6}$/')]
    public string $cor_sprint_atrasada = '#000000';

    #[Validate('regex:/^#[0-9a-fA-F]{6}$/')]
    public string $cor_sprint_concluida = '#000000';

    #[Validate('regex:/^#[0-9a-fA-F]{6}$/')]
    public string $cor_sprint_cancelada = '#000000';

    #[Validate('regex:/^#[0-9a-fA-F]{6}$/')]
    public string $cor_release_andamento = '#000000';

    #[Validate('regex:/^#[0-9a-fA-F]{6}$/')]
    public string $cor_release_atrasada = '#000000';

    #[Validate('regex:/^#[0-9a-fA-F]{6}$/')]
    public string $cor_release_concluida = '#000000';

    #[Validate('regex:/^#[0-9a-fA-F]{6}$/')]
    public string $cor_release_cancelada = '#000000';

    public ?ProjetoConfiguracao $configuracao = null;

    public function setProjetoConfiguracao(ProjetoConfiguracao $configuracao): void
    {
        $this->configuracao = $configuracao;

        $this->metrica_usuario = $configuracao->metrica_usuario;
        $this->metrica_horas = $configuracao->metrica_horas;
        $this->metrica_story_points = $configuracao->metrica_story_points;
        $this->cor_sprint_andamento = $configuracao->cor_sprint_andamento;
        $this->cor_sprint_atrasada = $configuracao->cor_sprint_atrasada;
        $this->cor_sprint_concluida = $configuracao->cor_sprint_concluida;
        $this->cor_sprint_cancelada = $configuracao->cor_sprint_cancelada;
        $this->cor_release_andamento = $configuracao->cor_release_andamento;
        $this->cor_release_atrasada = $configuracao->cor_release_atrasada;
        $this->cor_release_concluida = $configuracao->cor_release_concluida;
        $this->cor_release_cancelada = $configuracao->cor_release_cancelada;
    }

    public function update()
    {
        $this->validate();

        $this->configuracao->update($this->all());
    }
}
