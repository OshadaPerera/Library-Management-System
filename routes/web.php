<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;



Route::get('/', function () {
    return view('home');
});

// Auth routes
Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.post');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Books routes
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/add-book', [BookController::class, 'create'])->name('books.create');
Route::post('/books', [BookController::class, 'store'])->name('books.store');
Route::get('/books/{index}/edit', [BookController::class, 'edit'])->name('books.edit');
Route::post('/books/{index}', [BookController::class, 'update'])->name('books.update');
Route::delete('/books/{index}', [BookController::class, 'destroy'])->name('books.destroy');
Route::post('/books/{id}', [BookController::class, 'borrow'])->name('books.borrow');

// Additional routes
Route::get('/users', function () {
    return view('users');
});

Route::get('/signup', function () {
    return view('signup');
});

Route::get('/login', function () {
    return view('login');
});