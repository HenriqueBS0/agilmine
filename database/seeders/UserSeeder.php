<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@email.com',
                'password' => bcrypt('1a2s3d4f'),
                'habilitado' => true,
                'admin' => true,
                'key_redmine' => '701418bde932b0b4bbe560ccdf09eb2e33476ff6',
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
