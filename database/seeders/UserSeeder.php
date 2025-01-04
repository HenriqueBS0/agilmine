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
                'name' => 'Bruno Adam Ern',
                'email' => 'brunoadamern307@hotmail.com',
                'password' => bcrypt('bruno12345'),
                'habilitado' => true,
                'key_redmine' => '',
            ],
            [
                'name' => 'Cristhian Heck',
                'email' => 'cristhian.heck@ifc.edu.br',
                'password' => bcrypt('cristhian12345'),
                'habilitado' => true,
                'key_redmine' => '',
            ],
            [
                'name' => 'Felipe Caue Machado',
                'email' => 'fmachad6@gmail.com',
                'password' => bcrypt('felipe12345'),
                'habilitado' => true,
                'key_redmine' => '',
            ],
            [
                'name' => 'Gianluca Matos Klaumann',
                'email' => 'gianlucamk04@gmail.com',
                'password' => bcrypt('gianluca12345'),
                'habilitado' => true,
                'key_redmine' => '',
            ],
            [
                'name' => 'Lucas Kelim Thiel',
                'email' => 'lucas.kthiel@gmail.com',
                'password' => bcrypt('lucas12345'),
                'habilitado' => true,
                'key_redmine' => '',
            ],
            [
                'name' => 'Pedro Ryan',
                'email' => 'pedroryancoelhoiplinski@gmail.com',
                'password' => bcrypt('pedro12345'),
                'habilitado' => true,
                'key_redmine' => '',
            ],
            [
                'name' => 'Rodrigo Curvello',
                'email' => 'rodrigo.curvello@ifc.edu.br',
                'password' => bcrypt('rodrigo12345'),
                'admin' => true,
                'habilitado' => true,
                'key_redmine' => '',
            ],
            [
                'name' => 'Yohanês Zanghelini',
                'email' => 'yzanghelini@gmail.com',
                'password' => bcrypt('yohanes12345'),
                'habilitado' => true,
                'key_redmine' => '',
            ],
            [
                'name' => 'Henrique Borges dos Santos',
                'email' => 'henrique.10agr@gmail.com',
                'password' => bcrypt('henrique123'),
                'habilitado' => true,
                'key_redmine' => '',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
