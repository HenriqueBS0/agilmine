<?php

namespace App\Services\Metricas;

use App\Services\ApiRedmine\Entidades\Membro;
use App\Services\TarefaService;
use App\Services\LancamentosHorasService;

class MetricasMembro
{
    private Membro $membro;

    public function __construct(
        private TarefaService $tarefaService,
        private LancamentosHorasService $lancamentosHorasService,
        private MetricasTarefas $metricasTarefasDesenvolvedor,
        private MetricasLancamentosHoras $metricasLancamentosHoras
    ) {
    }

    public function setMembro(Membro $membro)
    {
        $this->membro = $membro;
        return $this;
    }

    public function setTarefas(array $tarefas)
    {
        $this->metricasTarefasDesenvolvedor->setTarefas(
            $this->tarefaService->filtraTarefasMembroDesenvolvedor(
                $tarefas,
                $this->membro
            )
        );

        $this->metricasLancamentosHoras->setLancamentos(
            $this->lancamentosHorasService->filtraLancamentosHorasMembro(
                $this->lancamentosHorasService->getLancamentosHorasTarefas($tarefas),
                $this->membro
            )
        );
    }

    public function tarefasDesenvolvedor()
    {
        return $this->metricasTarefasDesenvolvedor;
    }

    public function lancamentosHoras()
    {
        return $this->metricasLancamentosHoras;
    }
}