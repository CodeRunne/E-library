<?php

namespace App\Filament\Resources\BookResource\Pages;

use App\Filament\Resources\BookResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBook extends CreateRecord
{
    protected static string $resource = BookResource::class;

    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): string {
        return 'Book Added To Library';
    }

    // protected function mutateFormDataBeforeFill(array $data): array
    // {
    //     $data['total'] = auth()->id();

    //     return $data;
    // }
}
