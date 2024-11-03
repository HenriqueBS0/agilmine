<?php

namespace App\Livewire\Enums;

enum TipoAlerta: string
{
    case Sucesso = 'success';
    case Perigo = 'danger';
    case Atencao = 'warning';
    case Informacao = 'info';
}
