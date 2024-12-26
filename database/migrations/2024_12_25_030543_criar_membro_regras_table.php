<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membro_regras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('membro');
            $table->unsignedInteger('regra');
            $table->timestamps();

            $table->foreign('membro')->references('id')->on('projeto_membros')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membro_regras');
    }
};
