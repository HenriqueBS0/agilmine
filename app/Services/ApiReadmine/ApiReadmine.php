<?php

namespace App\Services\ApiReadmine;
use Illuminate\Support\Facades\Http;

class ApiReadmine
{
    /**
     * Retorna todos os objetos
     *
     * @template T of \App\Services\ApiReadmine\Entidades\Entidade
     * @param class-string<T> $entidade
     * @return ApiReadmineResponse<T[]>
     * @todo trabalhar com paginacao e generator
     */
    public function getAll(string $entidade, OpcoesBusca $opcoesBusca = null): mixed
    {
        $nomePlural = call_user_func([$entidade, 'getNomePlural']);

        $sUrl = "http://fabtec.ifc-riodosul.edu.br/{$nomePlural}.json?key=b7c238adc2c0af943c1f0fa9de6489ce190bd6d5";

        if ($opcoesBusca) {
            $sUrl .= "&{$opcoesBusca}";
        }

        $response = Http::get($sUrl);

        $data = array_map(function ($data) use ($entidade) {
            /** @var T $entidade */
            $entidade = new $entidade;
            $entidade->fromArray($data);
            return $entidade;
        }, $response->json($nomePlural));

        return (new ApiReadmineResponse())
            ->setData($data)
            ->setTotal($response->json('total_count'))
            ->setOffset($response->json('offset'))
            ->setLimit($response->json('limit'));
    }

    /**
     * Retorna todos objeto pelo id
     *
     * @template T of \App\Services\ApiReadmine\Entidades\Entidade
     * @param class-string<T> $entidade
     * @param int $id
     * @return ApiReadmineResponse<T>
     */
    public function getFromId(string $entidade, int $id): mixed
    {
        $nomePlural = call_user_func([$entidade, 'getNomePlural']);
        $nomeSingular = call_user_func([$entidade, 'getNomeSingular']);

        $response = Http::get("http://fabtec.ifc-riodosul.edu.br/{$nomePlural}/{$id}.json?key=b7c238adc2c0af943c1f0fa9de6489ce190bd6d5");
        /** @var T $entidade */
        $entidade = new $entidade;
        $entidade->fromArray($response->json($nomeSingular));

        return (new ApiReadmineResponse())
            ->setData($entidade)
            ->setTotal(1)
            ->setOffset(0)
            ->setLimit(1);
    }
}
