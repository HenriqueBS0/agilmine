<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Inserir configuração inicial da URL do Redmine
        DB::table('configuracoes')->insert([
            'key' => 'redmine_api_key_adm',
            'value' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('configuracoes')->where('key', 'redmine_api_key_adm')->delete();
    }
};
