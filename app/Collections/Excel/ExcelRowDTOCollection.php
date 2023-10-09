<?php

namespace App\Collections\Excel;

use App\Contracts\Collections\CollectionContract;
use App\Contracts\Collections\ExcelDTOCollection\ExcelDTOCollectionConcract;
use App\DataTransferObjects\Rows\RowDTO;
use Illuminate\Contracts\Support\Arrayable;

class ExcelRowDTOCollection implements CollectionContract, ExcelDTOCollectionConcract, Arrayable, \Countable
{
    /**
     * @var RowDTO[] $data
     */
    private array $data = [];

    /**
     * @return RowDTO[]
     */
    public function all(): array
    {
        return $this->data;
    }

    /**
     * @param RowDTO $rowDTO
     * @return void
     */
    public function add(RowDTO $rowDTO): void
    {
        $this->data[] = $rowDTO;
    }

    public function toArray()
    {
        return array_map(function (RowDTO $rowDTO){
            return [
                "name" => $rowDTO->name,
                "date" => $rowDTO->date->format("d.m.Y")
            ];
        }, $this->data);
    }

    public function count(): int
    {
        return count($this->data);
    }
}