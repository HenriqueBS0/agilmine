<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            $user = DB::table('users')->where('email', 'rodrigo.curvello@ifc.edu.br')->first();

            if ($user) {
                DB::table('users')
                    ->where('email', 'rodrigo.curvello@ifc.edu.br')
                    ->update([
                        'admin' => true,
                        'habilitado' => true,
                        'updated_at' => now(),
                    ]);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
};
