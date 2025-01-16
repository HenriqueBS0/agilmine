<?php

namespace App\Services\Metricas;

use App\Services\ApiRedmine\Entidades\Membro;
use App\Services\TarefaService;
use App\Services\LancamentosHorasService;

class MetricasLancamentosHoras
{
    /**
     * @param \App\Services\ApiRedmine\Entidades\LancamentoHora[] $lancamentos
     */
    public function __construct(
        private LancamentosHorasService $lancamentosHorasService,
        private array $lancamentos = []
    ) {
    }

    /**
     * Define os lancamentos que serão utilizados para extrair as métricas
     * 
     * @param \App\Services\ApiRedmine\Entidades\LancamentoHora[] $lancamentos
     * @return MetricasLancamentosHoras
     */
    public function setLancamentos(array $lancamentos): static
    {
        $this->lancamentos = $lancamentos;
        return $this;
    }

    public function horasLancadas()
    {
        return $this->lancamentosHorasService->somaHorasLancamentos($this->lancamentos);
    }
}