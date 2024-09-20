<?php

namespace App\Filament\Resources\TimestampResource\Pages;

use App\Filament\Resources\TimestampResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTimestamp extends EditRecord
{
    protected static string $resource = TimestampResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
