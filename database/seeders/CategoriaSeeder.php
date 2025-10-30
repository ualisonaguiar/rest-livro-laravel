<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            'Tecnologia',
            'Administração',
            'Educação',
            'Saúde',
            'Engenharia',
        ];

        foreach ($categorias as $nome) {
            Categoria::updateOrInsert(
                ['no_categoria' => $nome],
                ['in_ativo' => Categoria::STATUS_ATIVO]
            );
        }
    }
}
