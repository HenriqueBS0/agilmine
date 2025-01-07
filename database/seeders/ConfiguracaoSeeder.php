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
            'value' => 'http://redmine:3000',
        ]);

        Configuracao::updateOrCreate(['key' => 'redmine_api_key_adm'], [
            'value' => '701418bde932b0b4bbe560ccdf09eb2e33476ff6',
        ]);
    }
}
