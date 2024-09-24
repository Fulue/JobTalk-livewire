<?php

use App\Livewire\Answers;
use App\Livewire\Home;
use App\Livewire\ProfessionQuestions;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class);

Route::get('/profession/{professionId}/questions', ProfessionQuestions::class)->name('profession.questions');
Route::get('/profession/{professionId}/level/{levelId}/questions', ProfessionQuestions::class)->name('profession.questions.level');

Route::get('/answers/{questionId}', Answers::class)->name('answers');
