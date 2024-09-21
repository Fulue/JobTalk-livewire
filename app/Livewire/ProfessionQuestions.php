<?php

namespace App\Livewire;

use App\Models\Profession;
use App\Models\Question;
use Livewire\Component;

class ProfessionQuestions extends Component
{
    public $profession;  // Профессия
    public $questions;   // Список вопросов

    public function mount($professionId): void
    {
        $this->profession = Profession::query()->findOrFail($professionId);
        $this->questions = Question::query()->where('profession_id', $this->profession->id)->get();
    }
    public function render(): mixed
    {
        return view('livewire.profession-questions');
    }
}
