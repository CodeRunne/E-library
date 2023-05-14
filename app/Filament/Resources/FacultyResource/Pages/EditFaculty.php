<?php

namespace App\Filament\Resources\FacultyResource\Pages;

use App\Filament\Resources\FacultyResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFaculty extends EditRecord
{
    protected static string $resource = FacultyResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getSavedNotificationTitle(): string {
        return 'Faculty updated';
    }
}
