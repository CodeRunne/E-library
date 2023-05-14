<?php

use App\Http\Controllers\{DashboardController, ProfileController, LibraryController};
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');


Route::get('/library/profile', [ProfileController::class, 'edit'])->name('library.profile')->middleware('auth:student');

Route::middleware(['auth:student', 'verified'])->controller(App\Http\Controllers\LoanController::class)->group(function() {
    Route::get('/library/books', 'book')->name('library.books');
    Route::get('/library/books/history', 'history')->name('library.history');
});

Route::middleware(['auth:student', 'verified'])->controller(LibraryController::class)->group(function() {
    Route::get('/library', 'index')->name('library.index');
    Route::get('/library/reader/{book:slug}', 'reader')->name('library.reader');
    Route::get('/library/search', 'search')->name('library.search');
    Route::get('/library/{book:slug}', 'show')->name('library.show');
    Route::get('/library/categories/{category:slug}', 'category')->name('library.category.show');
    Route::post('/library/borrow/{book}', 'borrow')->name('library.borrow');
    Route::post('/library/return/{book}', 'return')->name('library.return');
});

Route::middleware('auth:student')->group(function () {
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';