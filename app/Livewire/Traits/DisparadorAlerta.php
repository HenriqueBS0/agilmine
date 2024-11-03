<?php

namespace App\Livewire\Traits;

use App\Livewire\Enums\TipoAlerta;

trait DisparadorAlerta
{
    private function alertaSucesso(string $mensagem, bool $now = false)
    {
        $this->dispararAlerta(TipoAlerta::Sucesso->value, $mensagem, $now);
    }

    private function alertaAtencao(string $mensagem, bool $now = false)
    {
        $this->dispararAlerta(TipoAlerta::Atencao->value, $mensagem, $now);
    }

    private function alertaPerigo(string $mensagem, bool $now = false)
    {
        $this->dispararAlerta(TipoAlerta::Perigo->value, $mensagem, $now);
    }

    private function alertaInformacao(string $mensagem, bool $now = false)
    {
        $this->dispararAlerta(TipoAlerta::Informacao->value, $mensagem, $now);
    }

    private function dispararAlerta(string $tipo, string $mensagem, $now = false)
    {
        if ($now) {
            session()->now('alerta', ['tipo' => $tipo, 'mensagem' => $mensagem]);
        } else {
            session()->flash('alerta', ['tipo' => $tipo, 'mensagem' => $mensagem]);
        }
    }
}
