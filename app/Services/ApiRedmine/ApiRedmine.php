<?php

namespace App\Services\ApiRedmine;
use App\Services\ApiRedmine\Operacoes\Listar\Parametros;
use App\Services\ApiRedmine\Operacoes\Listar\Retorno;
use Illuminate\Support\Facades\Http;

/**
 * Serviço para utilização da api do Redmine
 */
class ApiRedmine
{
    /**
     * Lista registros de um endpoint da api
     * @template T
     * @param Parametros<T> $parametros - Paramêtros para consultar os registros
     * @return Retorno<T> Objeto para acesso aos registros
     */
    public static function listar(Parametros $parametros): Retorno
    {
        $resposta = Http::withUrlParameters([
            'endpoint' => self::getEndpoint(),
            'caminho' => $parametros->caminho()->resolver()
        ])->get('{+endpoint}/{+caminho}', array_merge($parametros->getParametros(), ['key' => self::getKey()]));

        return new Retorno($parametros, $resposta);
    }

    private static function getEndpoint(): string
    {
        return env('API_REDMINE_URL', '');
    }

    private static function getKey(): string
    {
        return env('API_REDMINE_KEY', '');
    }
}
