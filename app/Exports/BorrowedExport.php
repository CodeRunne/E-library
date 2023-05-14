<?php

    namespace App\Exports;

    use App\Models\IssuedBooks;
    use Illuminate\Database\Eloquent\Collection;
    use Maatwebsite\Excel\Concerns\FromQuery;
    use Maatwebsite\Excel\Concerns\Exportable;
    use Maatwebsite\Excel\Concerns\FromCollection;


    class BorrowedExport implements FromQuery {

        use Exportable;

        public $borrowed;

        public function __construct(Collection $borrowed) {
            $this->borrowed = $borrowed;
        }

        public function query() {
            return IssuedBooks::whereKey($this->borrowed->pluck('id')->toArray());
        }

    }
