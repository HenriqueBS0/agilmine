<?php

namespace Tests\Support\Factories\ApiRedmine;

class TarefaFactory
{
    public const STATUS_ABERTA = ['id' => 1, 'name' => 'Aberta', 'is_closed' => false];
    public const STATUS_DESENVOLVIMENTO = ['id' => 2, 'name' => 'Desenvolvimento', 'is_closed' => false];
    public const STATUS_FECHADA = ['id' => 3, 'name' => 'Fechada', 'is_closed' => true];
    public const STATUS_CANCELADA = ['id' => 4, 'name' => 'Cancelada', 'is_closed' => true];
    public const STATUS_APROVACAO = ['id' => 5, 'name' => 'Aprovação', 'is_closed' => false];

    public const PRIORIDADE_BAIXA = ['id' => 1, 'name' => 'Baixa'];
    public const PRIORIDADE_MEDIA = ['id' => 2, 'name' => 'Média'];
    public const PRIORIDADE_ALTA = ['id' => 3, 'name' => 'Alta'];

    public const TRACKER_TEST = ['id' => 1, 'name' => 'test'];
    public const TRACKER_FEAT = ['id' => 2, 'name' => 'feat'];
    public const TRACKER_REFAC = ['id' => 3, 'name' => 'refac'];
    public const TRACKER_BUG = ['id' => 4, 'name' => 'bug'];
    public const TRACKER_DOC = ['id' => 5, 'name' => 'doc'];
    public const TRACKER_REQ = ['id' => 6, 'name' => 'req'];
    public const TRACKER_DESIGN = ['id' => 7, 'name' => 'design'];
    public const TRACKER_STUDY = ['id' => 8, 'name' => 'study'];
    public const TRACKER_REVERT = ['id' => 9, 'name' => 'revert'];
    public const TRACKER_INFRA = ['id' => 10, 'name' => 'infra'];
    public const TRACKER_BACKLOG = ['id' => 11, 'name' => 'backlog'];
    public const TRACKER_EPIC = ['id' => 12, 'name' => 'epic'];
    public const TRACKER_STORY = ['id' => 13, 'name' => 'story'];

    private static $statuses = [
        self::STATUS_ABERTA,
        self::STATUS_DESENVOLVIMENTO,
        self::STATUS_CANCELADA,
        self::STATUS_FECHADA,
        self::STATUS_APROVACAO,
    ];

    private static $priorities = [
        self::PRIORIDADE_ALTA,
        self::PRIORIDADE_MEDIA,
        self::PRIORIDADE_BAIXA,
    ];

    private static $trackers = [
        self::TRACKER_TEST,
        self::TRACKER_FEAT,
        self::TRACKER_REFAC,
        self::TRACKER_BUG,
        self::TRACKER_DOC,
        self::TRACKER_REQ,
        self::TRACKER_DESIGN,
        self::TRACKER_STUDY,
        self::TRACKER_REVERT,
        self::TRACKER_INFRA,
        self::TRACKER_BACKLOG,
        self::TRACKER_EPIC,
        self::TRACKER_STORY,
    ];

    public static function make($attributes = [])
    {

        return array_merge([
            'id' => fake()->unique()->randomNumber(),
            'subject' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'done_ratio' => fake()->numberBetween(0, 100),
            'total_estimated_hours' => fake()->randomFloat(2, 1, 100),
            'total_spent_hours' => fake()->randomFloat(2, 0, 100),
            'project' => [
                'id' => fake()->numberBetween(1, 100),
                'name' => fake()->sentence(3),
            ],
            'tracker' => self::$trackers[array_rand(self::$trackers)],
            'status' => self::$statuses[array_rand(self::$statuses)],
            'priority' => self::$priorities[array_rand(self::$priorities)],
            'author' => [
                'id' => fake()->randomNumber(),
                'name' => fake()->name,
            ],
            'assigned_to' => [
                'id' => fake()->randomNumber(),
                'name' => fake()->name,
            ],
            'custom_fields' => [
                ['id' => 2, 'value' => fake()->numberBetween(1, 20)], // Pontos de história
                ['id' => 3, 'value' => fake()->randomNumber()], // Descritor
                ['id' => 4, 'value' => fake()->randomNumber()], // Testador
            ],
            'start_date' => fake()->date('Y-m-d'),
            'due_date' => fake()->date('Y-m-d'),
            'created_on' => fake()->date('Y-m-d\TH:i:s\Z'),
            'updated_on' => fake()->date('Y-m-d\TH:i:s\Z'),
            'closed_on' => fake()->optional(0.3)->date('Y-m-d\TH:i:s\Z'),
        ], $attributes);
    }

    public static function collection($count = 1, $attributes = [])
    {
        return array_map(fn() => self::make($attributes), range(1, $count));
    }
}
