<?php

namespace Tests\Support\Factories\ApiRedmine;

class UsuarioFactory
{
    public static function make($attributes = [])
    {
        return array_merge([
            'id' => fake()->unique()->randomNumber(),
            'login' => fake()->userName,
            'admin' => fake()->boolean,
            'firstname' => fake()->firstName,
            'lastname' => fake()->lastName,
            'mail' => fake()->unique()->safeEmail,
            'created_on' => fake()->dateTimeBetween('-2 years', 'now')->format('Y-m-d\TH:i:s\Z'),
            'last_login_on' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d\TH:i:s\Z'),
            'api_key' => fake()->uuid,
        ], $attributes);
    }

    public static function collection($count = 1, $attributes = [])
    {
        return array_map(fn() => self::make($attributes), range(1, $count));
    }
}
