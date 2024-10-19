<?php

namespace App\Services\ApiRedmine\Operacoes;

/**
 * Interface de objetos que provem parâmetros para uma url.
 */
interface QueryParamProvider
{
    /**
     * Prove um array com os parâmetros da url
     *
     * @return array<string, string>
     */
    public function getParametros(): array;
}
