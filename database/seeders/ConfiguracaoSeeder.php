<?php

namespace Database\Seeders;

use App\Models\Configuracao;
use Illuminate\Database\Seeder;

class ConfiguracaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Configuracao::updateOrCreate(['key' => 'redmine_api_url'], [
            'value' => 'http://fabtec.ifc-riodosul.edu.br',
        ]);

        Configuracao::updateOrCreate(['key' => 'redmine_api_key_adm'], [
            'value' => '',
        ]);
    }
}
