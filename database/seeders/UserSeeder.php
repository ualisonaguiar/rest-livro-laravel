<?php

namespace Database\Seeders;

use App\Models\Users;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Users::updateOrInsert([
            'ds_nome'  => 'Ualison Aguiar da Ponte Frota',
            'ds_email' => 'ualison.aguiar@gmail.com',
            'ds_senha' => Hash::make('abcd1234'),
        ]);

        Users::updateOrInsert([
            'ds_nome'  => fake()->name(),
            'ds_email' => fake()->email(),
            'ds_senha' => Hash::make(fake()->password()),
        ]);
    }
}
