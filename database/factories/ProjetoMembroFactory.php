<?php

namespace Database\Factories;

use App\Models\ProjetoMembro;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjetoMembroFactory extends Factory
{
    protected $model = ProjetoMembro::class;

    public function definition()
    {
        return [
            'projeto_id' => \App\Models\Projeto::factory(),
            'membro' => $this->faker->randomNumber(),
            'nome' => $this->faker->name,
        ];
    }
}
