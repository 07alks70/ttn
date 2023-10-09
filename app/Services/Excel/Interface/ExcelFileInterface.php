<?php

namespace App\Services\Excel\Interface;

interface ExcelFileInterface
{
    public function rows(): int;

    public function getAllRows(): array;
}