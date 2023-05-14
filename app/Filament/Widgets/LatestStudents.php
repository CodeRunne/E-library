<?php

namespace App\Filament\Widgets;

use Closure;
use Filament\Tables;
use App\Models\Student;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;

class LatestStudents extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return Student::query()
            ->latest()
            ->take(8);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('id')
                ->sortable(),
            TextColumn::make('fullname')
            ->limit(20)
            ->sortable()
            ->searchable(),
            TextColumn::make('matric_no')
            ->limit(20)
            ->sortable()
            ->searchable(),
            TextColumn::make('department.name')
            ->sortable(),
            TextColumn::make('level.level')
            ->sortable(),
        ];
    }

    protected function isTablePaginationEnabled(): bool {
        return false;
    }
}
