<?php

namespace App\Filament\Resources\IssuedBooksResource\Pages;

use App\Filament\Resources\IssuedBooksResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIssuedBooks extends ListRecords
{
    protected static string $resource = IssuedBooksResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
