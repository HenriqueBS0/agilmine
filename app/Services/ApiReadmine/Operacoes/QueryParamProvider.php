<?php

namespace App\Services\ApiReadmine\Operacoes;

/**
 * Interface para fornecer a uma url.
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
