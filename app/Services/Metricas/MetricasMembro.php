<?php

namespace App\Services\Metricas;

use App\Services\ApiRedmine\Entidades\Membro;
use App\Services\TarefaService;

class MetricasMembro
{
    private Membro $membro;

    public function __construct(
        private TarefaService $tarefaService,
        private MetricasTarefas $tarefas
    ) {
    }

    public function setMembro(Membro $membro)
    {
        $this->membro = $membro;
        return $this;
    }

    public function setTarefas(array $tarefas)
    {
        $this->tarefas->setTarefas(
            $this->tarefaService->filtraTarefasDesenvolvedor(
                $tarefas,
                $this->membro->getUsuario()
            )
        );
    }

    public function tarefas()
    {
        return $this->tarefas;
    }
}