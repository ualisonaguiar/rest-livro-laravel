<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'ds_nome'  => 'Ualison Aguiar da Ponte Frota',
            'ds_email' => 'ualison.aguiar@gmail.com',
            'ds_senha' => md5('abcd1234'),
        ]);
    }
}
