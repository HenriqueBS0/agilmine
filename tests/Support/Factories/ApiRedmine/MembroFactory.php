<?php

namespace Tests\Support\Factories\ApiRedmine;

class MembroFactory
{
    public const ROLE_DEVELOPER = ['id' => 3, 'name' => 'Developer'];
    public const ROLE_MANAGER = ['id' => 4, 'name' => 'Manager'];
    public const ROLE_TEAM_LEADER = ['id' => 5, 'name' => 'Team Leader'];
    public const ROLE_INFRA = ['id' => 6, 'name' => 'Infra'];
    public const ROLE_ARQUITETO_SOFTWARE = ['id' => 7, 'name' => 'Arquiteto de Software'];
    public const ROLE_PRODUCT_OWNER = ['id' => 8, 'name' => 'Product Owner'];
    public const ROLE_TESTE_API = ['id' => 9, 'name' => 'Teste API'];
    public const ROLE_TESTER = ['id' => 10, 'name' => 'Tester'];
    public const ROLE_DEV_OPS = ['id' => 11, 'name' => 'DevOps'];
    private static $roles = [
        self::ROLE_DEVELOPER,
        self::ROLE_MANAGER,
        self::ROLE_TEAM_LEADER,
        self::ROLE_INFRA,
        self::ROLE_ARQUITETO_SOFTWARE,
        self::ROLE_PRODUCT_OWNER,
        self::ROLE_TESTE_API,
        self::ROLE_TESTER,
        self::ROLE_DEV_OPS
    ];

    public static function make($attributes = [])
    {
        // Verifica se roles foram passados nos atributos
        $roles = $attributes['roles'] ?? [self::$roles[array_rand(self::$roles)]];

        // Gera o objeto do membro
        return array_merge([
            'id' => fake()->unique()->randomNumber(),
            'project' => [
                'id' => fake()->numberBetween(1, 100),
                'name' => fake()->sentence(3),
            ],
            'user' => [
                'id' => fake()->unique()->randomNumber(),
                'name' => fake()->name,
            ],
            'roles' => $roles, // Usa os roles fornecidos ou aleatórios
        ], array_diff_key($attributes, ['roles' => '']));
    }

    public static function collection($count = 1, $attributes = [])
    {
        return array_map(fn() => self::make($attributes), range(1, $count));
    }
}
