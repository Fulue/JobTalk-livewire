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
    public bool $filtered = false;

    public function setLevel(string|null $levelId): void
    {
        $this->filtered = $levelId !== null;

        $this->questions = $this->getQuestions($levelId);
    }

    public function setTag(string|null $tagId): void
    {
        $this->filtered = $tagId !== null;
        $this->questions = $this->getQuestions(null, $tagId);
    }

    public function filterClear(): void
    {
        $this->filtered = false;
        $this->questions = $this->getQuestions();
    }

    private function getQuestions(?string $levelId = null, ?string $tagId = null): array
    {
        $profession = Profession::query()->findOrFail($this->profession['id']);

        return QuestionDTO::collect(
            $profession->questions()
                ->when($levelId, fn($query) => $query->where('level_id', $levelId))
                ->when($tagId, function ($query) use ($tagId) {
                    $query->whereHas('tags', function ($tagQuery) use ($tagId) {
                        $tagQuery->where('tag_id', $tagId);
                    });
                })
                ->orderByDesc('percentage')
                ->limit(20)
                ->get()
        )->toArray();
    }

    public function mount(string $professionId): void
    {
        $this->profession = ProfessionQuestionsDTO::from(Profession::query()->findOrFail($professionId))->toArray();
        $this->questions = $this->getQuestions();
    }

    #[Title('Questions')]
    public function render(): mixed
    {
        return view('livewire.profession-questions');
    }
}
