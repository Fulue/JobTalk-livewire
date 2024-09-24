<?php

namespace App\DTO;

use App\Models\Profession;
use Spatie\LaravelData\Data;

class ProfessionQuestionsDTO extends Data
{
    public function __construct(
        public string $id,
        public string $profession,
        public string $icon,
        public string $icon_color,
        public array $levels,
    ) {}

    public static function fromModel(Profession $profession): self
    {
        return new self(
            id: $profession->id,
            profession: $profession->profession,
            icon: $profession->icon,
            icon_color: $profession->icon_color,
            levels: LevelDTO::collect($profession->levels()->get())->toArray(),
        );
    }
}
