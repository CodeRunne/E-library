<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookResource\Pages;
use App\Filament\Resources\BookResource\RelationManagers;
use App\Models\Book;
use App\Exports\BooksExport;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\{Card, TextInput, Select, RichEditor};
use Filament\Forms\Components\{FileUpload, Toggle};
use Filament\Tables\Filters\{Filter, SelectFilter};
use Filament\Tables\Columns\{TextColumn, ImageColumn, IconColumn};
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;
use Livewire\TemporaryUploadedFile;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationGroup = 'Library';
    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

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
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                    TextInput::make('slug')
                    ->required()
                    ->disabled(),
                    TextInput::make('author')
                    ->required(),
                    FileUpload::make('book')
                    ->maxSize(512000)
                    ->label('E-Book')
                    ->directory('books')
                    ->acceptedFileTypes(['application/pdf']),
                    FileUpload::make('cover')
                    ->label('Book Cover')
                    ->image()
                    ->directory('books_cover')
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('16:9')
                    ->imageResizeTargetWidth('1920')
                    ->imageResizeTargetHeight('1080'),
                    RichEditor::make('description')
                    ->required(),
                    Toggle::make('published'),
                    Toggle::make('recommend')
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
                IconColumn::make('published')
                    ->trueIcon('heroicon-o-badge-check')
                    ->falseIcon('heroicon-o-badge-check')
            ])
            ->filters([
                SelectFilter::make('category')->relationship('category', 'name')
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
                ->action(fn (Collection $records) => (new BooksExport($records))->download('books.xlsx'))
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
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }    
}
