<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssuedBooks extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function book(int $id) {
        return static::where('book_id', $id)->whereNot('borrowed', false)->get();
    }

    public static function loanedBooks() {
        return static::where('student_matric_number', auth()->user()->matric_no)->where('borrowed', 1)->get();
    }

    public function getBook(int $id) {
        return Book::find($id);
    }

}
