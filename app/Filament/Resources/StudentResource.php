<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Filament\Resources\StudentResource\Widgets\StatsOverview;
use App\Models\Student;
use App\Exports\StudentsExport;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\{Card, Select};
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\Page;
use Filament\Resources\Pages\CreateRecord;
use Filament\Tables\Filters\{Filter, SelectFilter};
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;

class StudentResource extends Resource
{

    protected static ?string $title = 'Student | List';

    protected static ?string $navigationGroup = 'Management';
    
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('fullname')
                    ->maxLength(30)
                    ->required(),
                    TextInput::make('matric_no')
                    ->required(),
                    Select::make('department_id')
                        ->relationship('department', 'name'),
                    Select::make('level_id')
                        ->relationship('level', 'level'),
                    TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (Page $livewire) => ($livewire instanceof CreateRecord))
                    ->maxLength(255)
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
            ])
            ->filters([
                SelectFilter::make('department')->relationship('department', 'name'),
                SelectFilter::make('level')->relationship('level', 'level')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                BulkAction::make('export')
                ->label('Export Selected')
                ->icon('heroicon-o-download')
                ->action(fn (Collection $records) => (new StudentsExport($records))->download('students.xlsx'))
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getWidgets(): array {
        return [
            StatsOverview::class
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }    
}