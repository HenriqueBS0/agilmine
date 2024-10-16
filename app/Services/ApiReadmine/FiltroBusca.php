<?php

namespace App\Services\ApiReadmine;

class FiltroBusca
{
    private $igual = [];

    public function igual(string $parametro, int|string $valor): self
    {
        $this->igual[$parametro] = $valor;
        return $this;
    }

    private function igualToString(): string
    {
        $string = [];
        foreach ($this->igual as $parametro => $valor) {
            $string[] = "{$parametro}={$valor}";
        }
        return implode('&', $string);
    }

    public function __tostring()
    {
        return $this->igualToString();
    }
}
