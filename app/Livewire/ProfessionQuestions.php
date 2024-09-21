<?php

namespace App\Livewire;

use App\DTO\QuestionDTO;
use App\Models\Profession;
use App\Models\Question;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class ProfessionQuestions extends Component
{
    public $profession;
    public array $questions;

    public function mount($professionId): void
    {
        // Получаем профессию
        $this->profession = Profession::findOrFail($professionId);

        // Преобразуем вопросы профессии в коллекцию DTO и конвертируем в массив
        $this->questions = QuestionDTO::collect($this->profession->questions)->sortByDesc('percentage')->toArray();
    }
    #[Title('Questions')]
    public function render(): mixed
    {
        return view('livewire.profession-questions');
    }
}
