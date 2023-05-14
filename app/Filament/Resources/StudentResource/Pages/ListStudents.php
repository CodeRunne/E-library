<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use Filament\Pages\Actions;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\StudentResource\Widgets\StatsOverview;

class ListStudents extends ListRecords
{
    protected static string $resource = StudentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
        ];
    }


    protected function getHeaderWidgets(): array {
        return [
            StatsOverview::class
        ];
    }
}
