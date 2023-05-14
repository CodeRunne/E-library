<?php

namespace App\Filament\Resources\LevelResource\Pages;

use App\Filament\Resources\LevelResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLevel extends CreateRecord
{
    protected static string $resource = LevelResource::class;

    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): string {
        return 'Level Created';
    }

        protected function beforeCreate()
    {
        // Runs before the form fields are saved to the database.
    }
}
