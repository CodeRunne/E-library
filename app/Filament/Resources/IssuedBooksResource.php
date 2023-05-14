<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IssuedBooksResource\Pages;
use App\Filament\Resources\IssuedBooksResource\RelationManagers;
use App\Models\IssuedBooks;
use App\Exports\BorrowedExport;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\{TextColumn, IconColumn};
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\Layout\View;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IssuedBooksResource extends Resource
{
    protected static ?string $model = IssuedBooks::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Forms\Components\TextInput::make('student_matric_number')
                    ->required(),
                    Forms\Components\TextInput::make('book_id')
                        ->required(),
                    Forms\Components\DateTimePicker::make('return_date')
                        ->required(),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student_matric_number')
                ->searchable(),
                Tables\Columns\TextColumn::make('book_id'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Borrowed At'),
                Tables\Columns\TextColumn::make('return_date')
                    ->dateTime()
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
                ->action(fn (Collection $records) => (new BorrowedExport($records))->download('loan_history.xlsx'))
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIssuedBooks::route('/'),
            'create' => Pages\CreateIssuedBooks::route('/create'),
            'edit' => Pages\EditIssuedBooks::route('/{record}/edit'),
        ];
    }    
}
