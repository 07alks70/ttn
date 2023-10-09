<?php

namespace App\Contracts\Collections;

use App\DataTransferObjects\AbstractDTO;

interface CollectionContract
{
    public function all(): array;
}