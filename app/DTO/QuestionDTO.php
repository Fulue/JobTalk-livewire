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
        public float $percentage,  // Процент попадания в таймкоды
    ) {}

    public static function fromModel(Question $question): self
    {
        // Количество таймкодов, связанных с данным вопросом
        $questionTimestampsCount = $question->timestamps()->count(); ;

        // Количество таймкодов, связанных с данной темой
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
            percentage: round($percentage, 2), // Округляем до двух знаков
        );
    }
}
