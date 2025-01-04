<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('sprints', function (Blueprint $table) {
            // Adicionando o ID da versão no Redmine
            $table->unsignedInteger('versao')->nullable()->after('data_fim')->comment('ID da versão associada no Redmine');

            // Adicionando o campo resumo_release
            $table->text('resumo_release')->nullable()->after('gera_release')->comment('Resumo da release gerada pela sprint');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sprints', function (Blueprint $table) {
            // Removendo as colunas adicionadas
            $table->dropColumn('versao');
            $table->dropColumn('resumo_release');
        });
    }
};
