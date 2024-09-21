<?php

use App\Livewire\Home;
use App\Livewire\ProfessionQuestions;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class);
Route::get('/profession/{professionId}/questions', ProfessionQuestions::class)->name('profession.questions');
