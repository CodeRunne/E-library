<?php

namespace App\Filament\Resources\BookCategoryResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\{Card, TextInput, Select, RichEditor};
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\{Filter, SelectFilter};
use Filament\Tables\Columns\{TextColumn, ImageColumn};
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BooksRelationManager extends RelationManager
{
    protected static string $relationship = 'Books';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Select::make('category_id')
                        ->relationship('category', 'name'),
                    TextInput::make('title')
                    ->minLength(10)
                    ->maxLength(255)
                    ->required(),
                    TextInput::make('author')
                    ->required(),
                    FileUpload::make('cover')
                    ->label('Book Cover')
                    ->required(),
                    RichEditor::make('description')
                    ->required(),
                    TextInput::make('issues')
                    ->numeric()
                    ->required()
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('title')->limit(50)->sortable()->searchable()->wrap(),
                TextColumn::make('author')->limit(50)->sortable()->searchable(),
                ImageColumn::make('cover'),
                TextColumn::make('category.name')
                ->sortable()
                ->searchable(),
                TextColumn::make('available')->label('Available'),
                TextColumn::make('issues')->label('Total')
            ])
            ->filters([
                //
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
