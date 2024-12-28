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
        Schema::create('projeto_configuracoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('projeto_id');
            $table->boolean('metrica_usuario')->default(true);
            $table->boolean('metrica_horas')->default(true);
            $table->boolean('metrica_story_points')->default(true);
            $table->string('cor_sprint_andamento', 7)->default('#6711f2');
            $table->string('cor_sprint_atrasada', 7)->default('#FFAE00');
            $table->string('cor_sprint_concluida', 7)->default('#18FB4C');
            $table->string('cor_sprint_cancelada', 7)->default('#18FBE8');
            $table->string('cor_release_andamento', 7)->default('#6711f2');
            $table->string('cor_release_atrasada', 7)->default('#FFAE00');
            $table->string('cor_release_concluida', 7)->default('#18FB4C');
            $table->string('cor_release_cancelada', 7)->default('#18FBE8');
            $table->timestamps();

            // Relacionamento com projetos
            $table->foreign('projeto_id')->references('id')->on('projetos')->onDelete('cascade');
        });

        // Criar configurações padrão para projetos existentes
        $projetos = DB::table('projetos')->get();
        foreach ($projetos as $projeto) {
            DB::table('projeto_configuracoes')->insert([
                'projeto_id' => $projeto->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projeto_configuracoes');
    }
};
