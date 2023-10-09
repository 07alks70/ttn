<?php

namespace App\Services\Excel\Interface;

interface ExcelInterface
{
    public function loadFromFile(string $path): ExcelFileInterface;
}