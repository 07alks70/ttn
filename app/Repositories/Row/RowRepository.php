<?php

namespace App\Repositories\Row;

use App\Contracts\Repositories\RowRepositoryContract;
use App\DataTransferObjects\Rows\RowDTO;
use App\Events\NewRowCreated;
use App\Models\Row;

class RowRepository implements RowRepositoryContract
{

    public function getById(int $id): Row
    {
        return Row::find($id);
    }

    public function store(RowDTO $rowDTO): Row
    {
        $row = new Row();
        $row->name = $rowDTO->name;
        $row->date = $rowDTO->date;
        $row->save();

        event(new NewRowCreated($row));

        return $row;
    }
}