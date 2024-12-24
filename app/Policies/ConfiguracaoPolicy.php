<?php

namespace App\Policies;

use App\Models\User;

class ConfiguracaoPolicy
{
    /**
     * Determine se o usuário pode atualizar as configurações.
     */
    public function update(User $user): bool
    {
        return $user->admin;
    }
}
