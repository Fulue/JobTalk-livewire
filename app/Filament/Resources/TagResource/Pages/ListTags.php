<?php

namespace App\Filament\Resources\TagResource\Pages;

use App\Filament\Resources\TagResource;
use App\Models\Question;
use App\Models\Tag;
use App\Models\Timestamp;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Pages\ListRecords;

class ListTags extends ListRecords
{
    protected static string $resource = TagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('import_questions')
                ->form([
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


                    collect($json)->each(function ($record) use ($data) {
                        $question = Question::query()->whereLike('question', $record['question'])->first();

                        if ($question) {
                            // Обрабатываем теги
                            collect($record['tags'])->each(function ($tagName) use ($question) {
                                // Ищем или создаем тег
                                $tag = Tag::firstOrCreate(
                                    ['tag' => $tagName],
                                    [
                                        'color' => 'info',
                                        'icon' => 'heroicon-o-tag',
                                    ]
                                );

                                // Присоединяем тег к вопросу
                                $question->tags()->attach($tag);
                            });
                        }
                    });
                })
                ->color('info')
                ->label('Import Questions Json'),



            Actions\Action::make('import_timestamps')
                ->form([
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


                    collect($json)->each(function ($record) use ($data) {
                        $timestamp = Timestamp::query()->whereLike('question_text', $record['question'])->first();

                        if ($timestamp) {
                            // Обрабатываем теги
                            collect($record['tags'])->each(function ($tagName) use ($timestamp) {
                                // Ищем или создаем тег
                                $tag = Tag::query()->whereLike('tag', $tagName)->first();

                                if($tag){
                                    // Присоединяем тег к вопросу
                                    $timestamp->tags()->attach($tag);
                                }
                            });
                        }
                    });
                })
                ->color('info')
                ->label('Import Timestamps Json'),


            Actions\Action::make('import')
                ->form([
                    Textarea::make('json')
                        ->helperText('Format: {"tag": "string", "color": "string", "icon": "string"}')
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


                    collect($json)->each(function ($record) use ($data) {
                        $tag = Tag::query()->whereLike('tag', $record['tag'])->first();

                        if ($tag) {
                            $tag->color = $record['color'];
                            $tag->icon = $record['icon'];
                            $tag->save();
                        }
                    });
                })
                ->color('info')
                ->label('Import Icon Json'),
            Actions\CreateAction::make(),
        ];
    }
}
