<?php

namespace App\Services;

use App\Models\Configuracao;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;

class ConfiguracaoService
{
    /**
     * Atualiza a url do redmine
     * 
     * @param string $url - nova url
     * @return void
     * @throws AuthorizationException
     */
    public function atualizarUrlRedmine(string $url): void
    {
        if (Gate::denies('update', Configuracao::class)) {
            throw new AuthorizationException(__('messages.permission_denied'));
        }

        Configuracao::setValor(Configuracao::KEY_REDMINE_URL_API, $url);
    }

    /**
     * Atualiza a key administrativa do redmine
     * 
     * @param string $key - nova key
     * @return void
     * @throws AuthorizationException
     */
    public function atualizarKeyAdmRedmine(string $key): void
    {
        if (Gate::denies('update', Configuracao::class)) {
            throw new AuthorizationException(__('messages.permission_denied'));
        }

        Configuracao::setRedmineAdmKey($key);
    }
}
