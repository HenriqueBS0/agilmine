<?php

namespace App\Livewire\Traits;

use App\Services\ApiRedmine\ApiRedmine;
use App\Services\ApiRedmine\Entidades\Projeto;

trait ManipuladorProjeto
{
    public Projeto $projeto;

    private function setProjeto(int $projetoId)
    {
        $parametros = Projeto::parametroListar(1);
        $parametros->filtro()->igual('id', $projetoId);

        $this->projeto = ApiRedmine::listar($parametros)->dados()[0];
    }
}
