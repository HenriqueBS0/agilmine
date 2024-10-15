<?php

namespace App\Livewire\Dto;
use Livewire\Wireable;

class Paginacao implements Wireable
{
    public function __construct(
        private string $identificador,
        private int $paginas = 0,
        private int $paginaAtual = 0
    ) {

    }

    /**
     * Get the value of identificador
     */
    public function getIdentificador(): string
    {
        return $this->identificador;
    }

    /**
     * Set the value of identificador
     */
    public function setIdentificador(string $identificador): self
    {
        $this->identificador = $identificador;

        return $this;
    }

    /**
     * Get the value of paginas
     */
    public function getPaginas(): int
    {
        return $this->paginas;
    }

    /**
     * Set the value of paginas
     */
    public function setPaginas(int $paginas): self
    {
        $this->paginas = $paginas;

        return $this;
    }

    /**
     * Get the value of paginaAtual
     */
    public function getPaginaAtual(): int
    {
        return $this->paginaAtual;
    }

    /**
     * Set the value of paginaAtual
     */
    public function setPaginaAtual(int $paginaAtual): self
    {
        $this->paginaAtual = $paginaAtual;

        return $this;
    }

    public function toLivewire()
    {
        return [
            'identificador' => $this->getIdentificador(),
            'paginas' => $this->getPaginas(),
            'paginaAtual' => $this->getPaginaAtual()
        ];
    }

    public static function fromLivewire($value)
    {
        return (new self($value['identificador']))
            ->setPaginas($value['paginas'])
            ->setPaginaAtual($value['paginaAtual']);
    }
}
