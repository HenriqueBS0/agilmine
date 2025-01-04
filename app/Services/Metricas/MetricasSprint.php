<?php

namespace App\Services\Metricas;

use App\Models\Sprint;
use App\Services\SprintService;

class MetricasSprint
{
    private Sprint $sprint;

    public function __construct(
        private SprintService $sprintService,
        private MetricasTarefas $tarefas
    ) {
    }

    public function setSprint(Sprint $sprint)
    {
        $this->sprint = $sprint;
        return $this;
    }

    public function setTarefas(array $tarefas)
    {
        $this->tarefas()->setTarefas(
            $this->sprintService->getTarefas($this->sprint, $tarefas)
        );
        return $this;
    }

    public function velocidadeMediaPorDia()
    {
        $numeroDiasPercorridos = $this->numeroDiasPercorridos();

        if ($numeroDiasPercorridos <= 0) {
            return 0;
        }

        return $this->tarefas()->storyPointsFechadas() / $numeroDiasPercorridos;
    }

    public function velocidade()
    {
        return $this->tarefas()->storyPointsFechadas();
    }

    public function tarefasAbertasPorDiaRealizado()
    {
        $numero = [];

        $numeroTarefas = $this->tarefas()->numero();

        foreach ($this->tarefasFechadasPorDiaRealizado() as $data => $fechadas) {
            $numero[$data] = $numeroTarefas - $fechadas;
        }

        return $numero;
    }

    public function tarefasAbertasPorDiaEstimado()
    {
        $numero = [];

        $numeroTarefas = $this->tarefas()->numero();

        foreach ($this->tarefasFechadasPorDiaEstimado() as $data => $fechadas) {
            $numero[$data] = $numeroTarefas - $fechadas;
        }

        return $numero;
    }

    public function tarefasFechadasPorDiaRealizado()
    {
        $numero = [];
        foreach ($this->sprintService->dias($this->sprint) as $dia) {
            $numero[$dia->format('d/m/Y')] = $this->tarefas->concluidasAte($dia);
        }
        return $numero;
    }

    public function tarefasFechadasPorDiaEstimado()
    {
        $quantidadeEstimadaPorDia = $this->tarefas->numero() / $this->numeroDias();

        $numero = [];

        foreach ($this->sprintService->dias($this->sprint) as $indiceDia => $dia) {
            $numero[$dia->format('d/m/Y')] = max(
                0,
                round($quantidadeEstimadaPorDia * ($indiceDia + 1))
            );
        }

        return $numero;
    }

    public function numeroDiasRestantes()
    {
        return $this->numeroDias() - $this->numeroDiasPercorridos();
    }

    public function numeroDiasPercorridos()
    {
        return count($this->sprintService->diasPercorridos($this->sprint));
    }

    public function numeroDias()
    {
        return count($this->sprintService->dias($this->sprint));
    }

    public function tarefas()
    {
        return $this->tarefas;
    }
}