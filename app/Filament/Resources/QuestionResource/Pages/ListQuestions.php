<?php

namespace App\Filament\Resources\QuestionResource\Pages;

use App\Filament\Resources\QuestionResource;
use App\Models\Question;
use App\Models\Timestamp;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Pages\ListRecords;

class ListQuestions extends ListRecords
{
    protected static string $resource = QuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('recalculatePercentages')
                ->label('Recalculate Percentages')
                ->action(function (): void {
                    // Вызываем метод пересчета процентов для всех вопросов
                    Question::recalculatePercentages();
                })
                ->color('success')
                ->requiresConfirmation()
                ->modalHeading('Confirm Recalculation'),

            Actions\Action::make('import')
                ->form([
                    Select::make('profession_id')
                        ->relationship('profession', 'profession')
                        ->required(),
                    Textarea::make('json')
                        ->rows(10)
                        ->cols(20)
                        ->required()
                        ->placeholder('Введите JSON здесь...'),
                ])
                ->action(function (array $data): void {
                    // Декодируем JSON
                    $json = json_decode($data['json'], true);

                    // Проверяем, правильно ли декодировался JSON
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        throw new \Exception('Некорректный JSON: ' . json_last_error_msg());
                    }

                    // Регулярное выражение для извлечения таймкода и текста вопроса
                    $pattern = '/^(?P<start_time>\d{1,2}:\d{2}:\d{2},\d{3}) - (?P<question_text>.+)$/';

                    // Обрабатываем каждую запись
                    collect($json)->each(function ($record) use ($pattern, $data) {
                        // Создаем уникальный вопрос
                        $uniqueQuestion = Question::create([
                            'question' => $record['unique_question'],
                            'profession_id' => $data['profession_id'],
                        ]);

                        // Обрабатываем похожие вопросы
                        foreach ($record['most_similar_questions'] as $similarQuestion) {
                            // Разбиваем строку вопроса на таймкод и текст вопроса
                            if (preg_match($pattern, $similarQuestion['question'], $matches)) {
                                // Получаем таймкод и текст вопроса
                                $startTime = $matches['start_time'];
                                $questionText = $matches['question_text'];

                                // Ищем существующий таймкод по тексту вопроса и времени начала
                                $timestamp = Timestamp::query()
                                    ->where('question_text', $questionText)
                                    ->where('start_time', $startTime)
                                    ->first();

                                // Если таймкод существует, обновляем его поля
                                if ($timestamp) {
                                    $uniqueQuestion->timestamps()->attach($timestamp->id, [
                                        'similarity' => $similarQuestion['similarity'],
                                    ]);
                                }
                            }
                        }
                    });

                    // Вызываем метод пересчета процентов для всех вопросов
                    Question::recalculatePercentages();
                })
                ->color('info')
                ->label('Import Json'),
            Actions\CreateAction::make(),
        ];
    }
}
