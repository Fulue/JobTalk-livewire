<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class Home extends Component
{
    public $name = 'name';

    public function kekee(){
        dd($this->name);
    }

    #[Title('Home')]
    public function render()
    {
        return view('livewire.home');
    }
}
