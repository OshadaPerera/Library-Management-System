<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BorrowedBook extends Model
{
    protected $table = 'borrowed_books';

    protected $fillable = [
        'user_id',
        'book_id',
        'due_date',
        'returned_at',
    ];

    public $timestamps = true;

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}