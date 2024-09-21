<?php

namespace App\DTO;

use App\Models\Profession;
use Spatie\LaravelData\Data;

class ProfessionDTO extends Data
{
    public function __construct(
        public string $id,
        public string $name,
        public int $count,
        public string $icon,
        public string $icon_color,
    ) {}

    public static function fromModel(Profession $profession): self
    {
        return new self(
            id: $profession->id,
            name: $profession->name,
            count: $profession->questions->count(),
            icon: $profession->icon,
            icon_color: $profession->icon_color,
        );
    }
}
