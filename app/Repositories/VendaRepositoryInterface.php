<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface VendaRepositoryInterface {

    public function listagem(array $filters): LengthAwarePaginator;
}
