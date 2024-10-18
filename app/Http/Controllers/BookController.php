<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BorrowedBook; 

class BookController extends Controller
{
    // Display the list of books
    public function index(Request $request)
    {
        // Implement search functionality if needed
        $search = $request->input('search');

        // Fetch books with pagination
        $books = Book::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                         ->orWhere('author', 'like', "%{$search}%");
        })->paginate(10); // Use pagination instead of get()

        return view('books', compact('books'));
    }

    // Show the form to add a new book
    public function create()
    {
        return view('add-book');
    }

    // Store a new book
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'isbn' => 'required|string|max:13', // Assuming ISBN-13
            'quantity' => 'required|integer|min:1',
        ]);

        // Create a new book entry
        Book::create($request->only(['title', 'author', 'genre', 'isbn', 'quantity']));

        return redirect()->route('books.index')->with('success', 'New book added successfully.');
    }

    // Edit a book
    public function edit($id)
    {
        // Find the book by ID
        $book = Book::find($id);
        if (!$book) {
            return redirect()->route('books.index')->withErrors('Book not found.');
        }

        return view('books.edit', compact('book', 'id'));
    }

    // Update a book
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'isbn' => 'required|string|max:13',
            'quantity' => 'required|integer|min:1',
        ]);

        // Find the book and update it
        $book = Book::find($id);
        if (!$book) {
            return redirect()->route('books.index')->withErrors('Book not found.');
        }

        $book->update($request->only(['title', 'author', 'genre', 'isbn', 'quantity']));

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    // Delete a book
    public function destroy($id)
    {
        // Find the book and delete it
        $book = Book::find($id);
        if (!$book) {
            return redirect()->route('books.index')->withErrors('Book not found.');
        }

        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }

    // Borrow a book
// Borrow a book
public function borrow($id)
{
    // Fetch the book by ID
    $book = Book::find($id);
    if (!$book) {
        return redirect()->route('books.index')->withErrors('Book not found.');
    }

    // Check if the book is available
    if ($book->quantity <= 0) {
        return redirect()->route('books.index')->withErrors('This book is not available for borrowing.');
    }

    // Check if the user has already borrowed this book
    $hasBorrowed = BorrowedBook::where('user_id', auth()->id())
        ->where('book_id', $book->id)
        ->exists();

    if ($hasBorrowed) {
        return redirect()->route('books.index')->withErrors('You have already borrowed this book.');
    }

    // Create a new borrowed book entry
    BorrowedBook::create([
        'user_id' => auth()->id(), // Get the authenticated user ID
        'book_id' => $book->id,
        'due_date' => now()->addDays(14), // Set due date to 14 days from now
    ]);

    // Decrease the quantity of the book
    $book->decrement('quantity');

    return redirect()->route('books.index')->with('success', 'Book borrowed successfully. Please return it by ' . now()->addDays(14)->format('Y-m-d') . '.');
}

}