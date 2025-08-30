<?php

namespace App\Repositories;

use App\Models\Livro;

class LivroRepository implements LivroRepositoryInterface
{
    public function listagem() {
        return Livro::all();
    }

    public function getById(string $id): Livro {
        return Livro::findOrFail($id);
    }

    public function store(array $data): Livro {
        return Livro::create($data);
    }

    public function update(array $data, string $id): Livro {
        Livro::whereId($id)->update($data);

        return $this->getById($id);
    }

    public function delete($id): Livro {
        $product = $this->getById($id);
        Livro::destroy($id);

        return $product;
    }
}
