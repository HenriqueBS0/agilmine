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
            ],
            [
                'name' => 'Cristhian Heck',
                'email' => 'cristhian.heck@ifc.edu.br',
                'password' => bcrypt('cristhian12345'),
            ],
            [
                'name' => 'Felipe Caue Machado',
                'email' => 'fmachad6@gmail.com',
                'password' => bcrypt('felipe12345'),
            ],
            [
                'name' => 'Gianluca Matos Klaumann',
                'email' => 'gianlucamk04@gmail.com',
                'password' => bcrypt('gianluca12345'),
            ],
            [
                'name' => 'Lucas Kelim Thiel',
                'email' => 'lucas.kthiel@gmail.com',
                'password' => bcrypt('lucas12345'),
            ],
            [
                'name' => 'Pedro Ryan',
                'email' => 'pedroryancoelhoiplinski@gmail.com',
                'password' => bcrypt('pedro12345'),
            ],
            [
                'name' => 'Rodrigo Curvello',
                'email' => 'rodrigo.curvello@ifc.edu.br',
                'password' => bcrypt('rodrigo12345'),
            ],
            [
                'name' => 'Yohanês Zanghelini',
                'email' => 'yzanghelini@gmail.com',
                'password' => bcrypt('yohanes12345'),
            ],
            [
                'name' => 'Henrique Borges dos Santos',
                'email' => 'henrique.10agr@gmail.com',
                'password' => bcrypt('henrique123'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
