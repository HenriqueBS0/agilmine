<?php

namespace App\Services;

use App\Models\User;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;

class UserService
{
    /**
     * Atualiza o status de admin de um usuário.
     *
     * @param User $usuario O usuário a ser atualizado.
     * @param bool $admin Novo status de admin.
     * @return bool
     * @throws AuthorizationException
     */
    public function atualizarAdmin(User $usuario, bool $admin): bool
    {
        // Verifica se o usuário autenticado tem permissão para atualizar este modelo
        if (Gate::denies('update', $usuario)) {
            throw new AuthorizationException(__('messages.permission_denied'));
        }

        if (auth()->id() === $usuario->id) {
            throw new \Exception(__('messages.self_permission_change'));
        }

        $usuario->admin = $admin;
        return $usuario->save();
    }

    /**
     * Atualiza o estado de habilitado de um usuário.
     *
     * @param User $usuario O usuário a ser atualizado.
     * @param bool $habilitado Situação.
     * @return bool
     * @throws AuthorizationException
     */
    public function atualizarHabilitado(User $usuario, bool $habilitado): bool
    {
        // Verifica se o usuário autenticado tem permissão para atualizar este modelo
        if (Gate::denies('update', $usuario)) {
            throw new AuthorizationException(__('messages.permission_denied'));
        }

        if (auth()->id() === $usuario->id) {
            throw new \Exception(__('messages.self_account_disable'));
        }

        $usuario->habilitado = $habilitado;
        return $usuario->save();
    }
}
