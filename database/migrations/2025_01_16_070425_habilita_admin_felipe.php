<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::transaction(function () {
            $user = DB::table('users')->where('email', 'fmachad6@gmail.com')->first();

            if ($user) {
                DB::table('users')
                    ->where('email', 'fmachad6@gmail.com')
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
     */
    public function down(): void
    {
        //
    }
};
