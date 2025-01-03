<?php

namespace App\Policies;

use App\Models\Projeto;
use App\Models\User;
use App\Services\UserService;

class ProjetoPolicy
{
    public function __construct(private UserService $userService)
    {
    }

    public function isGestor(User $user, Projeto $projeto): bool
    {
        if (!$this->userService->getRedmineId($user)) {
            return false;
        }

        // Verificar se o usuário é membro do projeto
        $membro = $projeto->membros()
            ->where('membro', $this->userService->getRedmineId($user))
            ->first();

        // Verificar se o membro tem uma das regras (4 - Manager ou 5 - Team Leader)
        return $membro && $membro->regras()->whereIn('regra', [4, 5])->exists();
    }

    public function isMembro(User $user, Projeto $projeto): bool
    {
        if (!$this->userService->getRedmineId($user)) {
            return false;
        }

        // Verificar se o usuário é membro do projeto
        return $projeto->membros()
            ->where('membro', $this->userService->getRedmineId($user))
            ->exists();
    }

    public function isMetricaMembroAtiva(User $user, Projeto $projeto)
    {
        return $projeto->configuracao->metrica_usuario === true;
    }

    public function isMetricaHorasAtiva(User $user, Projeto $projeto)
    {
        return $projeto->configuracao->metrica_horas === true;
    }

    public function isMetricaStoryPointsAtiva(User $user, Projeto $projeto)
    {
        return $projeto->configuracao->metrica_story_points === true;
    }
}
