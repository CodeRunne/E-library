<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Mchev\BanHammer\Facades\Banhammer;
use App\Models\{Book, Category, IssuedBooks, ReturnedBooks};

class LibraryController extends Controller
{

    public function index() {
        $latest = Book::where('published', true)->latest()->take(12)->get();
        $categories = Category::latest()->get();
        $sections = Category::take(3)->get();

        return view('library.index', [
            'latest' => $latest,
            'categories' => $categories,
            'sections' => $sections
        ]);
    }

    public function show(Book $book)
    {
        $borrowed = $book->borrowed;
        $categories = Category::take(5)->get();
        $related = $book->related($book->author, $book->id);

        $issued = false;
        if($borrowed) {
            $issued = IssuedBooks::where('student_matric_number', auth()->user()->matric_no)->where('book_id', $book->id)->get();
            $issued = $issued->count() > 0 ? $issued : null;
        }

        return view('library.show', [
            'book' => $book,
            'relatedBooks' => $related,
            'borrowed' => $borrowed,
            'categories' => $categories,
            'issued' => $issued ?? null
        ]);
    }

    public function search(Request $request) {
        $result = Book::where('title', 'like', '%' . $request->search . '%')->orWhere('author', 'like', '%' . $request->search . '%')->paginate(20);

        if($request->search == null) {
            abort(404);
        }

        return view('library.search', [
            'results' => $result,
            'query' => $request->search
        ]);
    }

    public function category(Category $category)
    {
        return view('library.category', [
            'category' => $category
        ]);
    }

    public function borrow(Request $request, Book $book) 
    {
        $attributes = $request->validate(['return_date' =>'required']);

        if(strtotime($request->return_date) < time()) {
            return back()->withErrors(['return_date' => 'Pick a Future Date.'])
                        ->withInput();
        }

        $issued = IssuedBooks::create([
            'book_id' => $book->id,
            'student_matric_number' => auth()->user()->matric_no,
            'borrowed' => true,
            'return_date' => $request->return_date
        ]);

        if($issued) {
            $book->borrowed = true;
            $book->save();
        }

        return back()->with('success', 'Book has been borrowed by you');
    }


    public function return(Request $request, Book $book) {
        
        $book->borrowed = false;
        $book->save();
        
        if($book) {
            $issued = (new IssuedBooks)->book($book->id);
            $issued = IssuedBooks::find($issued[0]->id);
            $issued->borrowed = false;
            $issued->save();
        }

        return redirect()->route('library.show', $book)->with('success', "Book has been returned by you");
    }

    public function reader(Request $request, Book $book) {

        $borrowed = IssuedBooks::where('book_id', $book->id)
            ->where('student_matric_number', auth()->user()->matric_no)
            ->where('borrowed', true)
            ->get()->first();
        
        if($borrowed == null) {
            abort(403);
        }

        return view('library.reader', [
            'book' => $book
        ]);
    }
 }
