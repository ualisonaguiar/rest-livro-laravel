<?php

namespace Database\Seeders;

use App\Models\Livro;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LivroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 1000; $i++) {
            $livro = [
                'no_nome' => 'Livro ' . Str::title(fake()->words(3, true)),
                'no_autor' => fake()->name(),
                'nu_quantidade' => fake()->numberBetween(5, 100),
                'nu_preco' => fake()->randomFloat(2, 10, 300),
                'dt_lancamento' => fake()->dateTimeBetween('-10 years', 'now')->format('Y-m-d'),
            ];
            Livro::updateOrInsert($livro);
        }
    }
}
