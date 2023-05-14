<?php

namespace App\Filament\Resources\IssuedBooksResource\Pages;

use App\Filament\Resources\IssuedBooksResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIssuedBooks extends EditRecord
{
    protected static string $resource = IssuedBooksResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }
}
