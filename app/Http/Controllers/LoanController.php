<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Book, IssuedBooks};

class LoanController extends Controller
{
    public function book() {
        $book = new Book;
        $books = IssuedBooks::loanedBooks();
        $recommended = $book->recommended();

        // dd($books);

        return view('library.book', [
            'books' => $books,
            'recommended' => $recommended
        ]);
    }

    public function history() {
        $borrowed = IssuedBooks::where('student_matric_number', auth()->user()->matric_no)->latest()->paginate(5);
        
        return view('library.history', [
            'books' => $borrowed
        ]);
    }
}
