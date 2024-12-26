<?php

namespace App\Policies;

use App\Models\Projeto;
use App\Models\User;

class ProjetoPolicy
{
    public function isGestor(User $user, Projeto $projeto): bool
    {
        if (!$user->getRedmineId()) {
            return false;
        }

        // Verificar se o usuário é membro do projeto
        $membro = $projeto->membros()
            ->where('membro', $user->getRedmineId())
            ->first();

        // Verificar se o membro tem uma das regras (4 - Manager ou 5 - Team Leader)
        return $membro && $membro->regras()->whereIn('regra', [4, 5])->exists();
    }

    public function isMembro(User $user, Projeto $projeto): bool
    {
        if (!$user->getRedmineId()) {
            return false;
        }

        // Verificar se o usuário é membro do projeto
        return $projeto->membros()
            ->where('membro', $user->getRedmineId())
            ->exists();
    }
}
