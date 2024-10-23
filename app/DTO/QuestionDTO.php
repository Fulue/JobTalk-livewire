<?php

namespace App\DTO;

use App\Models\Question;
use App\Models\Timestamp;
use Spatie\LaravelData\Data;

class QuestionDTO extends Data
{
    public function __construct(
        public string $id,
        public string $question,
        public string|null $level,
        public string|null $level_icon,
        public array $tags,
        public float $percentage,
    ) {}

    public static function fromModel(Question $question): self
    {
        return new self(
            id: $question->id,
            question: $question->question,
            level: $question->level->level??null,
            level_icon: $question->level->icon??null,
            tags: TagDTO::collect($question->tags()->get())->toArray(),
            percentage: round($question->percentage, 2),
        );
    }
}
