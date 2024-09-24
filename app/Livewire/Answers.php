<?php

namespace App\Livewire;

use App\DTO\QuestionAnswersDTO;
use App\Models\Question;
use Livewire\Attributes\Title;
use Livewire\Component;

class Answers extends Component
{
    public array $answer = [];
    public array $question = [];
    public function mount($questionId): void
    {
        $question = Question::query()->findOrFail($questionId);
        $this->question = QuestionAnswersDTO::from($question)->toArray();

        $this->answer =  $question->answers()->get()->toArray();
    }
    #[Title('Answers')]
    public function render(): mixed
    {
        return view('livewire.answers');
    }
}
