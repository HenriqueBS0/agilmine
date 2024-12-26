<?php

namespace Tests\Support;

use Http;
use Tests\Support\Factories\ApiRedmine\MembroFactory;
use Tests\Support\Factories\ApiRedmine\UsuarioFactory;
use Tests\Support\Factories\ApiRedmine\ProjetoFactory;

trait FakesApiRedmine
{
    /**
     * Fake the API response for project members.
     *
     * @param array $projetos List of projects.
     * @param array $usuario User data.
     * @param array $regrasMembroPrincipal Roles for the main member.
     * @return void
     */
    private function fakeMembros($projetos, $usuario, $regrasMembroPrincipal = [])
    {
        foreach ($projetos as $projeto) {
            $membroPrincipal = $this->createMembroPrincipal($projeto, $usuario, $regrasMembroPrincipal);

            $outrosMembros = MembroFactory::collection(5, [
                'projeto' => ['id' => $projeto['id'], 'name' => $projeto['name']]
            ]);

            $membros = array_merge($outrosMembros, [$membroPrincipal]);

            Http::fake([
                "http://fabtec.ifc-riodosul.edu.br/projects/{$projeto['id']}/memberships.json*" => Http::response([
                    'memberships' => $membros,
                    'total_count' => count($membros),
                    'offset' => 0,
                    'limit' => 25,
                ])
            ]);
        }
    }

    /**
     * Create the main member for a project.
     *
     * @param array $projeto Project data.
     * @param array $usuario User data.
     * @param array $regras Roles for the main member.
     * @return array
     */
    private function createMembroPrincipal($projeto, $usuario, $regras = [])
    {

        $attributes = [
            'projeto' => ['id' => $projeto['id'], 'name' => $projeto['name']],
            'user' => ['id' => $usuario['id'], 'name' => "{$usuario['firstname']} {$usuario['lastname']}"],
        ];

        if (count($regras)) {
            $attributes['roles'] = $regras;
        }

        return MembroFactory::make($attributes);
    }

    /**
     * Fake the API response for projects.
     *
     * @param int $numeroProjetos Number of projects to generate.
     * @return array
     */
    private function fakeProjetos($numeroProjetos = 5)
    {
        $projetos = ProjetoFactory::collection($numeroProjetos);

        Http::fake([
            'http://fabtec.ifc-riodosul.edu.br/projects.json*' => Http::response([
                'projects' => $projetos,
                'total_count' => count($projetos),
                'offset' => 0,
                'limit' => 25,
            ])
        ]);

        return $projetos;
    }

    /**
     * Fake the API response for a user.
     *
     * @param array $attributes Attributes to override.
     * @return array
     */
    private function fakeUsuario($attributes = [])
    {
        $usuario = UsuarioFactory::make($attributes);

        Http::fake([
            'http://fabtec.ifc-riodosul.edu.br/my/account.json*' => Http::response([
                'user' => $usuario,
            ])
        ]);

        return $usuario;
    }
}
