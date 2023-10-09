<?php

namespace App\Contracts\Collections\ExcelDTOCollection;

use App\DataTransferObjects\Rows\RowDTO;

interface ExcelDTOCollectionConcract
{
    public function add(RowDTO $rowDTO): void;
}