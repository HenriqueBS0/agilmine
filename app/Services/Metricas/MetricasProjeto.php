<?php

namespace App\Services\Metricas;

use App\Models\Enums\SprintStatus;
use App\Models\Projeto;
use App\Services\ProjetoService;
use App\Services\SprintService;

class MetricasProjeto
{
    private Projeto $projeto;

    private array $tarefas;

    public function __construct(
        private ProjetoService $projetoService,
        private SprintService $sprintService
    ) {
    }

    public function setProjeto(Projeto $projeto)
    {
        $this->projeto = $projeto;
        return $this;
    }

    public function setTarefas($tarefas)
    {
        $this->tarefas = $tarefas;
        return $this;
    }

    /**
     * Retorna o número de sprints do projeto
     * @return int
     */
    public function numeroSprints()
    {
        return count($this->getSprintsProjeto());
    }

    public function numeroSprintsConcluidas()
    {
        $sprints = $this->sprintService->filtraSprintsPelosStatus(
            $this->getSprintsProjeto(),
            $this->tarefas,
            [SprintStatus::CONCLUIDA]
        );

        return count($sprints);
    }

    public function numeroSprintsEmAndamento()
    {
        $sprints = $this->sprintService->filtraSprintsPelosStatus(
            $this->getSprintsProjeto(),
            $this->tarefas,
            [SprintStatus::EM_ANDAMENTO, SprintStatus::EM_ANDAMENTO_ATRASADA]
        );

        return count($sprints);
    }

    public function numeroReleases()
    {
        return count($this->sprintService->filtraSprintsGeramRelease(
            $this->getSprintsProjeto()
        ));
    }

    private function getSprintsProjeto()
    {
        return $this->projetoService->getSprintsMetricas($this->projeto)->get()->all();
    }
}