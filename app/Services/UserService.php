<?php

namespace App\Services;

use App\Contracts\FetchRedmineInterface;
use App\Models\User;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Str;

class UserService
{
    public function __construct(private FetchRedmineInterface $fetchRedmine)
    {
    }

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

    /**
     * Gera uma nova senha para o usuário.
     *
     * @param User $usuario O usuário a ser atualizado.
     * @return string nova senha
     * @throws AuthorizationException
     */
    public function gerarNovaSenha(User $usuario): string
    {
        // Verifica se o usuário autenticado tem permissão para atualizar este modelo
        if (Gate::denies('update', $usuario)) {
            throw new AuthorizationException(__('messages.permission_denied'));
        }

        $novaSenha = Str::random(10);
        $usuario->password = bcrypt($novaSenha);
        $usuario->save();

        return $novaSenha;
    }

    /**
     * Obtém o ID do usuário no Redmine.
     *
     * @return int|null
     */
    public function getRedmineId(User $usuario): ?int
    {
        if ($usuario->key_redmine === null) {
            return null;
        }

        if (is_int($usuario->id_usuario_redmine)) {
            return $usuario->id_usuario_redmine;
        }

        try {
            $usuario->id_usuario_redmine = $this->fetchRedmine->usuario()->getId();
            $usuario->save();

            return $usuario->id_usuario_redmine;
        } catch (\Throwable $th) {
            return null;
        }
    }
}
