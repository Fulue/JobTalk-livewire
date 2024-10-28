<?php

namespace App\Filament\Resources\VideoResource\Pages;

use App\Filament\Resources\VideoResource;
use App\Models\Video;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Pages\ListRecords;

class ListVideos extends ListRecords
{
    protected static string $resource = VideoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('import_questions')
                ->form([
                    Select::make('profession_id')
                        ->relationship('profession', 'profession')
                        ->required(),
                    Select::make('user_id')
                        ->relationship('user', 'name')
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


                    collect($json)->each(function ($record) use ($data) {
                        Video::create([
                            'name' => $record['title'],
                            'url' => $record['url'],
                            'user_id' => $data['user_id'],
                            'profession_id' => $data['profession_id'],
                            'status' => 'processed',
                        ]);
                    });
                })
                ->color('info')
                ->label('Import Video Json'),
            Actions\CreateAction::make(),
        ];
    }
}
