<?php

namespace App\Exports;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class BooksExport implements FromQuery, ShouldAutoSize, WithMapping, WithHeadings
{
    use Exportable;

    public $books;

    public function __construct(Collection $books) {
        $this->books = $books;
    }

    public function query() {
        return Book::whereKey($this->books->pluck('id')->toArray());
    }

    public function map($book): array
        {
            return [
                $book->id,
                $book->title,
                $book->author,
                $book->description,
                $book->published ? 'published' : 'not-published',
                Date::dateTimeToExcel($book->created_at)
            ];
        }

        public function headings(): array
        {
            return [
                'ID',
                'Title',
                'Author',
                'Description',
                'Published',
                'Created At'
            ];
        }
}
