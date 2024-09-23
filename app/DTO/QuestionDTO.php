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
        public string $level,
        public string $level_icon,
        public array $tags,
        public float $percentage,
    ) {}

    public static function fromModel(Question $question): self
    {
        // Количество тайм-кодов, связанных с данным вопросом
        $questionTimestampsCount = $question->timestamps()->count(); ;

        // Количество тайм-кодов, связанных с данной темой
        $totalTimestamps = $question->profession->questions()->get()
            ->map(fn($question) => $question->timestamps()->count())
            ->sum();

        // Рассчитываем процент попадания
        $percentage = $totalTimestamps > 0
            ? ($questionTimestampsCount / $totalTimestamps) * 100
            : 0;

        return new self(
            id: $question->id,
            question: $question->question,
            level: $question->level->level,
            level_icon: $question->level->icon,
            tags: $question->tags()->get()->toArray(),
            percentage: round($percentage, 2),
        );
    }
}
