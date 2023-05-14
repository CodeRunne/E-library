<?php

namespace App\Filament\Resources\BookCategoryResource\Pages;

use App\Filament\Resources\BookCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBookCategories extends ListRecords
{
    protected static string $resource = BookCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
