<?php

namespace Tests\Support;

use Livewire\Features\SupportTesting\Testable;

trait AssercoesModal
{
    public function assertAbrirModal(string $id, Testable $componente): self
    {
        $componente->assertDispatched('abrir-modal', id: $id);
        return $this;
    }

    public function assertFecharModal(string $id, Testable $componente): self
    {
        $componente->assertDispatched('fechar-modal', id: $id);
        return $this;
    }
}
