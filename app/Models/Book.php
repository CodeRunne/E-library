<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'author',
        'book',
        'cover',
        'description',
        'published',
        'recommend'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function related(string $author, int $id) {
        return static::where('author', $author)
                        ->whereNot('id', $id)
                        ->get();
    }

    public function recommended() {
        return static::where('recommend', true)->latest()->take(8)->get();
    }

    public function findBook($loans, int $paginate = null) {
        $bookIds = $loans->map(fn($loan) => $loan->book_id);
        $books = $bookIds->map(fn($id) => static::find($id));

        return $books;
    }
}
