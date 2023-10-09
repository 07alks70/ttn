<?php

namespace App\Contracts\Repositories;

use App\DataTransferObjects\Rows\RowDTO;
use App\Models\Row;

interface RowRepositoryContract
{
    public function getById(int $id): Row;

    public function store(RowDTO $rowDTO): Row;
}