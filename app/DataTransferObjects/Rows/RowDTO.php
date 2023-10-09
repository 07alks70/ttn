<?php

namespace App\DataTransferObjects\Rows;

use Illuminate\Support\Carbon;

class RowDTO
{
    public function __construct(
        public string $name,
        public Carbon $date
    )
    {}
}