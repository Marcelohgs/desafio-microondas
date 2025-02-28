<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Adicionando um usuário de exemplo
        DB::table('users')->insert([
            'name' => 'Marcelo Henrique',
            'email' => 'marcello_ike@hotmail.com',
            'password' => bcrypt('1234'), // Senha criptografada
        ]);
    }
}
