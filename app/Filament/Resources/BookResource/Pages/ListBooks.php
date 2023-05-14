<?php

namespace App\Filament\Resources\BookResource\Pages;

use App\Filament\Resources\BookResource;
use Filament\Pages\Actions;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use App\Models\User;
use Filament\Forms;

class ListBooks extends ListRecords
{
    protected static string $resource = BookResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
        ];
    }
}
