<?php

namespace Tests\Support\Factories\ApiRedmine;

class ProjetoFactory
{
    public static function make($attributes = [])
    {
        return array_merge([
            'id' => fake()->unique()->randomNumber(),
            'name' => fake()->sentence(3),
            'identifier' => fake()->slug,
            'description' => fake()->paragraph,
            'status' => 1,
            'is_public' => fake()->boolean,
            'inherit_members' => fake()->boolean,
            'created_on' => fake()->dateTimeBetween('-2 years', 'now')->format('Y-m-d\TH:i:s\Z'),
            'updated_on' => fake()->dateTimeBetween('now', '+1 year')->format('Y-m-d\TH:i:s\Z'),
        ], $attributes);
    }

    public static function collection($count = 1, $attributes = [])
    {
        return array_map(fn() => self::make($attributes), range(1, $count));
    }
}
