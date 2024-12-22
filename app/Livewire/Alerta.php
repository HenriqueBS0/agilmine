<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Alerta extends Component
{
    public string $tipo = '';
    public string $mensagem = '';

    public function mount()
    {
        // Inicializa o alerta com os dados da sessão, se disponíveis
        if (session()->has('alerta')) {
            $this->tipo = session()->get('alerta')['tipo'];
            $this->mensagem = session()->get('alerta')['mensagem'];
        }
    }

    #[On('alerta')]
    public function receberAlerta(array $alerta)
    {
        $this->tipo = $alerta['tipo'];
        $this->mensagem = $alerta['mensagem'];
    }

    public function render()
    {
        return view('livewire.alerta');
    }
}
