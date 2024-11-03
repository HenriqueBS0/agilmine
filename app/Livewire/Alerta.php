<?php

namespace App\Livewire;

use Livewire\Component;

class Alerta extends Component
{
    public string $tipo;

    public string $mensagem;

    public function mount()
    {
        $this->tipo = session()->get('alerta')['tipo'];
        $this->mensagem = session()->get('alerta')['mensagem'];
    }

    public function render()
    {
        return view('livewire.alerta');
    }
}
