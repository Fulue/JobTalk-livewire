<?php

namespace App\Livewire;

use App\DTO\ProfessionQuestionsDTO;
use App\DTO\QuestionDTO;
use App\Models\Profession;
use App\Models\Question;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Title;
use Livewire\Component;

class ProfessionQuestions extends Component
{
    #[Locked]
    public array $profession = [];
    #[Locked]
    public array $questions = [];

    public function mount(string $professionId, string|null $levelId = null): void
    {
        // Получаем профессию
        $profession = Profession::query()->findOrFail($professionId);

        // Преобразуем вопросы профессии в коллекцию DTO и конвертируем в массив
        $this->questions = QuestionDTO::collect(
            $profession->questions()
                ->when($levelId, fn($query) => $query->where('level_id', $levelId))
                ->get()
        )->sortByDesc('percentage')->toArray();

        $this->profession = ProfessionQuestionsDTO::from($profession)->toArray();
    }
    #[Title('Questions')]
    public function render(): mixed
    {
        return view('livewire.profession-questions');
    }
}
