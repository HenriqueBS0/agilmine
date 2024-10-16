<?php

namespace App\Services\ApiReadmine;

/**
 * @template T
 */
class ApiReadmineResponse
{
    /**
     * @var T
     */
    private mixed $data;

    private int $total;

    private int $offset;

    private int $limit;



    /**
     * Get the value of data
     */
    public function getData(): mixed
    {
        return $this->data;
    }

    /**
     * Set the value of data
     */
    public function setData($data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the value of total
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * Set the value of total
     */
    public function setTotal(int $total): self
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get the value of offset
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * Set the value of offset
     */
    public function setOffset(int $offset): self
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * Get the value of limit
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * Set the value of limit
     */
    public function setLimit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    public function paginas(): int
    {
        return ceil($this->getTotal() / $this->getLimit());
    }

    public function paginaAtual(): int
    {
        return floor(($this->getOffset() + 1) / $this->getLimit()) + 1;
    }

    public function proximaPagina(): ?int
    {
        $paginaAtual = $this->paginaAtual();
        $ultimaPagina = $this->paginas();

        if ($paginaAtual >= $ultimaPagina) {
            return null;
        }

        return $paginaAtual + 1;
    }

    public function paginaAnterior(): ?int
    {
        $paginaAtual = $this->paginaAtual();

        if ($paginaAtual <= 1) {
            return null;
        }

        return $paginaAtual - 1;
    }

}
