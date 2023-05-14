<?php

namespace App\Filament\Resources\FacultyResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\{Card, TextInput, Select, RichEditor};
use Filament\Tables\Filters\{Filter, SelectFilter};
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DepartmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'Departments';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextColumn::make('id')
                ->sortable(),
                TextColumn::make('name')
                ->searchable(),
                TextColumn::make('faculty.name')
                ->searchable()
                ->sortable()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                ->sortable(),
                TextColumn::make('name')
                ->searchable(),
                TextColumn::make('faculty.name')
                ->searchable()
                ->sortable()
            ])
            ->filters([
                SelectFilter::make('faculty')->relationship('faculty', 'name')
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AssociateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DissociateAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DissociateBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
}
