<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookCategoryResource\Pages;
use App\Filament\Resources\BookCategoryResource\RelationManagers;
use App\Filament\Resources\BookCategoryResource\RelationManagers\BooksRelationManager;
use App\Models\Category;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Tables\Actions\BulkAction;

class BookCategoryResource extends Resource
{
    protected static ?string $model = Category::class;
    protected static ?string $navigationGroup = 'Library';
    protected static ?string $navigationIcon = 'heroicon-o-folder';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')
                    ->minLength(4)
                    ->maxLength(20)
                    ->required()
                    ->reactive()
                    ->helperText('Book Category Names.')
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                    TextInput::make('slug')
                    ->disabled()
                    ->required()
                    ->unique(Category::class, 'slug', fn ($record) => $record),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name')->limit(50)->sortable()->searchable(),
                TextColumn::make('slug')->limit(50),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                BulkAction::make('export')
                ->label('Export Selected')
                ->icon('heroicon-o-download')
                ->action(fn (Collection $records) => (new BooksExport($records))->download('books.xlsx'))
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            BooksRelationManager::class
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookCategories::route('/'),
            'create' => Pages\CreateBookCategory::route('/create'),
            'edit' => Pages\EditBookCategory::route('/{record}/edit'),
        ];
    }    
}