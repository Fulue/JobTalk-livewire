<?php

namespace App\Filament\Resources\TimestampResource\Pages;

use App\Filament\Resources\TimestampResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTimestamp extends CreateRecord
{
    protected static string $resource = TimestampResource::class;
}
