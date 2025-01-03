<?php

namespace App\Services\Metricas;

use App\Services\ApiRedmine\Entidades\Tarefa;
use App\Services\TarefaService;
use Illuminate\Support\Carbon;
class MetricasTarefas
{
    /**
     * @param Tarefa[] $tarefas
     */
    public function __construct(
        private TarefaService $tarefaService,
        private array $tarefas = [],
    ) {
    }

    public function setTarefas($tarefas)
    {
        $this->tarefas = $tarefas;
        return $this;
    }

    public function concluidasAte(Carbon $data)
    {
        return count($this->tarefaService->filtraTarefasDataConclusaoMenorIgual($this->tarefas, $data));
    }

    public function numero()
    {
        return count($this->tarefas);
    }

    public function numeroFechadas()
    {
        return count($this->fechadas());
    }

    public function numeroAbertas()
    {
        return count($this->abertas());
    }

    public function horasEstimadaAbertasRestantes()
    {
        $restantes = $this->horasEstimadasAbertas() - $this->horasGastasAbertas();

        if ($restantes < 0) {
            $restantes = 0;
        }

        return $restantes;
    }

    public function horasEstimadas()
    {
        return self::somaHorasEstimadas($this->tarefas);
    }

    public function horasEstimadasFechadas()
    {
        return self::somaHorasEstimadas($this->fechadas());
    }

    public function horasEstimadasAbertas()
    {
        return self::somaHorasEstimadas($this->abertas());
    }

    public function horasGastas()
    {
        return self::somaHorasGastas($this->tarefas);
    }

    public function horasGastasFechadas()
    {
        return self::somaHorasGastas($this->fechadas());
    }

    public function horasGastasAbertas()
    {
        return self::somaHorasGastas($this->abertas());
    }

    public function storyPoints()
    {
        return self::somaStoryPoints($this->tarefas);
    }

    public function storyPointsFechadas()
    {
        return self::somaStoryPoints($this->fechadas());
    }

    public function storyPointsAbertas()
    {
        return self::somaStoryPoints($this->abertas());
    }

    private function fechadas()
    {
        return $this->tarefaService->filtraTarefasStatusFechada($this->tarefas, true);
    }

    private function abertas()
    {
        return $this->tarefaService->filtraTarefasStatusFechada($this->tarefas, false);
    }

    private static function somaStoryPoints($tarefas)
    {
        return array_reduce($tarefas, function ($soma, Tarefa $tarefa) {
            return $soma + $tarefa->getPontosHistoria();
        }, 0);
    }

    private static function somaHorasEstimadas($tarefas)
    {
        return round(array_reduce($tarefas, function ($soma, Tarefa $tarefa) {
            return $soma + $tarefa->getHorasEstimadas();
        }, 0), 2);
    }

    private static function somaHorasGastas($tarefas)
    {
        return round(array_reduce($tarefas, function ($soma, Tarefa $tarefa) {
            return $soma + $tarefa->getHorasGastas();
        }, 0), 2);
    }
}