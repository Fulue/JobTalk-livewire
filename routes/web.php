<?php

use App\Livewire\Answers;
use App\Livewire\Home;
use App\Livewire\ProfessionQuestions;
use Cloudstudio\Ollama\Facades\Ollama;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class);

Route::get('/profession/{professionId}/questions', ProfessionQuestions::class)->name('profession.questions');
Route::get('/profession/{professionId}/level/{levelId}/questions', ProfessionQuestions::class)->name('profession.questions.level');

Route::get('/answers/{questionId}', Answers::class)->name('answers');


function compareQuestions($question1, $question2): bool
{
    // Формируем запрос для модели Ollama
    $response = Ollama::model('gemma2:latest')
        ->prompt("
         Ниже я написал два вопроса можешь сраванить их если у них один и тот же смысл ответь 'true' если разный ответь 'false'.\n\n
        Вопрос 1: {$question1}\n\n
        Вопрос 2: {$question2}
        ")
        ->ask();

    // Приводим ответ к нижнему регистру и убираем лишние пробелы и символы
    dump($response['response']);
    $cleanResponse = strtolower(trim($response['response'], ". \n"));

    // Проверяем ответ на 'true' или 'false'
    return $cleanResponse === 'true';
}

Route::get('/test', function () {

    $question1 = "В чем разница между конструкциями WHERE и HAVING в SQL?";
    $question2 = "Чем отличаются WHERE и HAVING в SQL?";
    return dd(compareQuestions($question1, $question2));
});
