<?php

namespace App\Livewire;

use App\DTO\ProfessionDTO;
use App\Models\Profession;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Home extends Component
{
    public array $professions = [];

    public function mount(): void
    {
       $Profession = Profession::query()->find('9d10ad62-71fc-473c-9eda-a68ae7b843f2');
       //dd($Profession->videos);
       // $this->professions = ProfessionDTO::collect(Profession::query()->get())->toArray();
    }

    #[Title('Home')]
    #[Layout('components.layouts.app-no-header')]
    public function render(): mixed
    {
        return view('livewire.home');
    }
}
