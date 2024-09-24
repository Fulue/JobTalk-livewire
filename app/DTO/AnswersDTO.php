<?php

namespace App\DTO;

use App\Models\Answer;
use App\Models\Timestamp;
use Spatie\LaravelData\Data;

class AnswersDTO extends Data
{
    public function __construct(
        public string $id,
        public string $answer,
        public string $created_at
    ) {}

    public static function fromModel(Answer $answer): self
    {
        return new self(
            id: $answer->id,
            answer: $answer->answer,
            created_at: $answer->created_at
        );
    }
}
