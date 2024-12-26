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
        Schema::create('projeto_membros', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->unsignedInteger('projeto_id');
            $table->unsignedInteger('membro');
            $table->timestamps();

            // Relacionamento com projetos
            $table->foreign('projeto_id')->references('id')->on('projetos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projeto_membros');
    }
};
