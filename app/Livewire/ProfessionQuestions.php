<?php

namespace App\Livewire;

use App\DTO\ProfessionQuestionsDTO;
use App\DTO\QuestionDTO;
use App\Helpers\PaginationHelper;
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

    public bool $list = false;
    public int $currentPage = 1;
    public int $lastPage;

    public function setTypeView( bool $list ): void
    {
        $this->list = $list;
    }
    public function setLevel(string|null $levelId): void
    {
        $this->filtered = $levelId !== null;
        $this->questions = $this->getQuestions($levelId);

        $this->dispatch('scrollToTop');
    }

    public function setTag(string|null $tagId): void
    {
        $this->filtered = $tagId !== null;
        $this->questions = $this->getQuestions(null, $tagId);

        $this->dispatch('scrollToTop');
    }

    public function filterClear(): void
    {
        $this->filtered = false;
        $this->questions = $this->getQuestions();

        $this->dispatch('scrollToTop');
    }

    public function newPage(int $page): void
    {
        $this->currentPage = $page;
        $this->questions = $this->getQuestions();

        $this->dispatch('scrollToTop');
    }

    private function getQuestions(?string $levelId = null, ?string $tagId = null): array
    {
        $profession = Profession::query()->findOrFail($this->profession['id']);

        $perPage = 50;
        $questions = PaginationHelper::paginate(
            $profession->questions()
                ->when($levelId, fn($query) => $query->where('level_id', $levelId))
                ->when($tagId, function ($query) use ($tagId) {
                    $query->whereHas('tags', function ($tagQuery) use ($tagId) {
                        $tagQuery->where('tag_id', $tagId);
                    });
                })
                ->orderByDesc('percentage'),
            $perPage,
            $this->currentPage
        );

        $this->lastPage = $questions['lastPage'];

        return QuestionDTO::collect($questions['items'])->toArray();
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
