<?php

namespace App\Filament\Resources\IssuedBooksResource\Pages;

use App\Filament\Resources\IssuedBooksResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateIssuedBooks extends CreateRecord
{
    protected static string $resource = IssuedBooksResource::class;

//     protected function handleRecordCreation(array $data): Model
// {
//     return static::getModel()::create($data);
// }
}
