<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface VendaServiceInterface {

    public function listagem(array $filters): LengthAwarePaginator;
}
