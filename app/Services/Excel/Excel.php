<?php

namespace App\Services\Excel;

use App\Services\Excel\Interface\ExcelInterface;
use App\Services\Excel\Interface\ExcelFileInterface;
use Shuchkin\SimpleXLSX;

class Excel implements ExcelFileInterface, ExcelInterface
{
    public SimpleXLSX $excelFile;

    public function loadFromFile(string $path): ExcelFileInterface
    {
        $this->excelFile = SimpleXLSX::parseFile($path);
        return $this;
    }

    public function rows(): int
    {
        return count($this->excelFile->rows());
    }

    public function getAllRows(): array
    {
        return $this->excelFile->rows();
    }
}