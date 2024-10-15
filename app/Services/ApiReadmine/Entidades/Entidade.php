<?php

namespace App\Services\ApiReadmine\Entidades;

interface Entidade
{
    public static function getNomeSingular(): string;

    public static function getNomePlural(): string;

    public function fromArray(array $data): self;
}
