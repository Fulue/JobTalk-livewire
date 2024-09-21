<?php

namespace App\DTO;

use Spatie\LaravelData\Data;

class ProfessionDTO extends Data
{
    public function __construct(
        public string $id,
        public string $name,
        //public int $count,
    ) {}
}
