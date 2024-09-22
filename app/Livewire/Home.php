<?php

namespace App\Livewire;

use App\DTO\ProfessionDTO;
use App\Models\Level;
use App\Models\Profession;
use App\Models\Timestamp;
use App\Models\Video;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Home extends Component
{
    public array $professions = [];

    public function mount(): void
    {
        $Profession = Profession::query()->find('9d12a9f2-3ceb-4059-a759-0f8a696b655f');
//        $videos = new Collection;
//        $question = $Profession->levels()->get()->map(
//            static fn(Level|Collection $level) => $level->videos()->get()->map(
//                fn(Video|Collection $video) => $video->timestamps()->get()->map(
//                    fn(Timestamp|Collection $timestamp) => $timestamp->question
//                )
//            )
//        );
        dd($question);
    }

    #[Title('Home')]
    #[Layout('components.layouts.app-no-header')]
    public function render(): mixed
    {
        return view('livewire.home');
    }
}
