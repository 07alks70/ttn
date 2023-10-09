<?php

namespace App\Contracts\Action\Excel;

use App\Collections\Excel\ExcelRowDTOCollection;
use App\Services\Excel\Interface\ExcelFileInterface;
use Illuminate\Http\JsonResponse;

interface CreateJobContract
{
    public function handle(string $path): void;
}