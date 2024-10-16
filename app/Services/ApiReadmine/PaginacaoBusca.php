<?php

namespace App\Services\ApiReadmine;

class PaginacaoBusca
{
    private int $offset = 0;

    private int $limit = 10;

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

    public function __tostring()
    {
        return "offset={$this->getOffset()}&limit={$this->getLimit()}";
    }
}
