<?php

namespace App\Livewire\Traits;

trait DisparadorModal
{
    public function abrirModal(string $id)
    {
        $this->dispatch('abrir-modal', id: $id);
    }

    /**
     * Dispara um evento para fechar um modal.
     *
     * @param string $id ID do modal
     */
    public function fecharModal(string $id)
    {
        $this->dispatch('fechar-modal', id: $id);
    }
}
