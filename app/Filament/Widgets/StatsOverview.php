<?php

namespace App\Filament\Widgets;

use App\Models\{Book, IssuedBooks, Student};
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make("Total Students", Student::all()->count()),
            Card::make("Total Books", Book::all()->count()),
            Card::make("Loaned Books", IssuedBooks::where('borrowed', true)->get()->count())
        ];
    }
}
