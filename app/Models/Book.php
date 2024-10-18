<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // Specify the table associated with the model
    protected $table = 'books';

    // Specify the primary key (optional if the name is 'id')
    protected $primaryKey = 'id';

    // Disable auto-incrementing if you are not using it (optional, by default it is enabled)
    public $incrementing = true;

    // Disable timestamps if not using created_at and updated_at (optional)
    public $timestamps = true;

    // Specify which attributes should be mass assignable
    protected $fillable = [
        'title',
        'author',
        'genre',
        'isbn',
        'quantity',
        'available_quantity',
        'updated_at',
        'created_at',
    ];
}