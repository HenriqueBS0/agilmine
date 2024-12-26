<?php

namespace Database\Factories;

use App\Models\Projeto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjetoFactory extends Factory
{
    protected $model = Projeto::class;

    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(),
            'nome' => $this->faker->sentence(3),
            'descricao' => $this->faker->paragraph(),
            'arquivado' => false,
        ];
    }
}
