<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sprints', function (Blueprint $table) {
            $table->id()->comment('ID único da sprint');
            $table->unsignedSmallInteger('project_id')->comment('ID do projeto ao qual a sprint pertence');
            $table->unsignedSmallInteger('serial')->comment('Código da sprint dentro do projeto');

            $table->unique(['project_id', 'serial'], 'unique_sprint_serial_por_projeto');

            $table->string('nome', 100)->comment('Nome');
            $table->text('resumo')->comment('Resumo/Descrição');
            $table->date('data_inicio')->comment('Data de Inicio da Sprint');
            $table->date('data_fim')->comment('Data de Fim da Sprint');
            $table->boolean('gera_release')->comment('Se a sprint gera release');
            $table->json('tarefas')->default(new Expression('(JSON_ARRAY())'))->comment("Id's das tarefas da sprint");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('sprints');
    }
};
