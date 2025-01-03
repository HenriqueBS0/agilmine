<?php

namespace App\Services;

use Illuminate\Support\Carbon;

class DataTimeUtil
{

    /**
     * Gera os dias úteis entre duas datas.
     *
     * @param \Illuminate\Support\Carbon $dataInicial
     * @param \Illuminate\Support\Carbon $dataFinal
     * @return \Illuminate\Support\Carbon[]
     */
    public function gerarDiasUteis(Carbon $dataInicial, Carbon $dataFinal): array
    {
        $dataAtual = clone $dataInicial;
        $dataAtual->setTime(0, 0, 0, 0);

        $dias = [];

        while ($dataAtual <= $dataFinal) {
            if ($dataAtual->format('N') <= 5) {
                $dias[] = clone $dataAtual;
            }

            $dataAtual->modify('+1 day');
        }

        return $dias;
    }

    /**
     * Pega um array de datas e faz um map para d/m/Y
     * 
     * @param Carbon[] $dias
     * @return array
     */
    public function diasMapString(array $dias)
    {
        return array_map(
            function (Carbon $dia) {
                return $dia->format('d/m/Y');
            },
            $dias
        );
    }

    /**
     * Pega um número de horas em float e converte para HH:mm
     * @param float $horas
     * @return string
     */
    public function horasFloatToString(float $horas)
    {
        $h = floor($horas);
        $m = round(($horas - $h) * 60);

        return sprintf('%02d:%02d', $h, $m);
    }
}