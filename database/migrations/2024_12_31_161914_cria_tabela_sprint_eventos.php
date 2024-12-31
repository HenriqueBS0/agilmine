<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sprint_eventos', function (Blueprint $table) {
            $table->id()->comment('ID único do evento');
            $table->foreignId('sprint_id')->constrained('sprints')->onDelete('cascade')->comment('ID da sprint associada');
            $table->unsignedTinyInteger('tipo')->comment('Tipo do evento (baseado no enum EventoTipo)');
            $table->text('descricao')->comment('Descrição do evento');
            $table->json('participantes')->comment('IDs dos membros participantes');
            $table->dateTime('data_hora')->comment('Data e hora do evento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sprint_eventos');
    }
};
