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
            ],
            [
                'name' => 'Cristhian Heck',
                'email' => 'cristhian.heck@ifc.edu.br',
                'password' => bcrypt('cristhian12345'),
                'habilitado' => true,
            ],
            [
                'name' => 'Felipe Caue Machado',
                'email' => 'fmachad6@gmail.com',
                'password' => bcrypt('felipe12345'),
                'habilitado' => true,
            ],
            [
                'name' => 'Gianluca Matos Klaumann',
                'email' => 'gianlucamk04@gmail.com',
                'password' => bcrypt('gianluca12345'),
                'habilitado' => true,
            ],
            [
                'name' => 'Lucas Kelim Thiel',
                'email' => 'lucas.kthiel@gmail.com',
                'password' => bcrypt('lucas12345'),
                'habilitado' => true,
            ],
            [
                'name' => 'Pedro Ryan',
                'email' => 'pedroryancoelhoiplinski@gmail.com',
                'password' => bcrypt('pedro12345'),
                'habilitado' => true,
            ],
            [
                'name' => 'Rodrigo Curvello',
                'email' => 'rodrigo.curvello@ifc.edu.br',
                'password' => bcrypt('rodrigo12345'),
                'admin' => true,
                'habilitado' => true,
            ],
            [
                'name' => 'Yohanês Zanghelini',
                'email' => 'yzanghelini@gmail.com',
                'password' => bcrypt('yohanes12345'),
                'habilitado' => true,
            ],
            [
                'name' => 'Henrique Borges dos Santos',
                'email' => 'henrique.10agr@gmail.com',
                'password' => bcrypt('henrique123'),
                'habilitado' => true,
            ],
        ];

        foreach ($users as $user) {
            // Verifica se o usuário já existe
            $existingUser = User::where('email', $user['email'])->first();

            if ($existingUser) {
                // Se existir, atualiza apenas o campo admin
                $existingUser->update(['admin' => $user['admin'] ?? false]);
            } else {
                // Se não existir, cria o registro com todos os dados
                User::create($user);
            }
        }
    }
}
