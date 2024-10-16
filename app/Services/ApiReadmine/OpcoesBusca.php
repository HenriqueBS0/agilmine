<?php

namespace App\Services\ApiReadmine;

class OpcoesBusca
{
    public function __construct(
        private FiltroBusca $filtroBusca = new FiltroBusca,
        private PaginacaoBusca $paginacaoBusca = new PaginacaoBusca
    ) {
    }

    public function filtro(): FiltroBusca
    {
        return $this->filtroBusca;
    }

    public function paginacao(): PaginacaoBusca
    {
        return $this->paginacaoBusca;
    }

    public function __tostring()
    {
        return implode('&', [
            $this->filtroBusca,
            $this->paginacaoBusca
        ]);
    }
}
