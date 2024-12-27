<?php

namespace Tests\Support;

use App\Models\User;
use App\Services\ProjetoService;
use Http;
use Tests\Support\Factories\ApiRedmine\MembroFactory;
use Tests\Support\Factories\ApiRedmine\TarefaFactory;
use Tests\Support\Factories\ApiRedmine\UsuarioFactory;
use Tests\Support\Factories\ApiRedmine\ProjetoFactory;

trait FakesApiRedmine
{

    private function fakeMembros($projetos, $usuario, $regrasMembroPrincipal = [])
    {
        $membrosProjetos = [];

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

            $membrosProjetos[$projeto['id']] = $membros;
        }

        return $membrosProjetos;
    }
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

    private function fakeTarefas($projetos, $quantidadePorProjeto = 5, $attributes = [])
    {

        $tarefasPorProjeto = [];

        foreach ($projetos as $projeto) {
            $tarefas = TarefaFactory::collection(
                $quantidadePorProjeto,
                array_merge([
                    'project' => ['id' => $projeto['id'], 'name' => $projeto['name']],
                ], $attributes)
            );

            Http::fake([
                "http://fabtec.ifc-riodosul.edu.br/projects/{$projeto['id']}/issues.json*" => Http::response([
                    'issues' => $tarefas,
                    'total_count' => count($tarefas),
                    'offset' => 0,
                    'limit' => 25,
                ])
            ]);

            $tarefasPorProjeto[$projeto['id']] = $tarefas;
        }

        return $tarefasPorProjeto;
    }

    private function fakeCompleto($regrasUsuarioRedmine = [MembroFactory::ROLE_DEVELOPER])
    {
        $usuario = $this->fakeUsuario();
        $projetos = $this->fakeProjetos(5);
        $membrosProjetos = $this->fakeMembros($projetos, $usuario, $regrasUsuarioRedmine);
        $tarefasProjetos = $this->fakeTarefas($projetos, 5);

        $usuarioSistema = User::factory()->create([
            'key_redmine' => $usuario['api_key'],
            'id_usuario_redmine' => $usuario['id']
        ]);

        return [
            'usuario' =>
                [
                    'redmine' => $usuario,
                    'sistema' => $usuarioSistema
                ],
            'projetos' => $projetos,
            'membrosProjetos' => $membrosProjetos,
            'tarefasProjetos' => $tarefasProjetos,
        ];
    }
}
