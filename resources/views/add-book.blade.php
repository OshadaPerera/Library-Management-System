@extends('layouts.layout')

@section('title', 'Add Book')

@section('content')

<!-- Add Book Form Section -->
<section class="py-20">
    <div class="container mx-auto px-6 lg:px-20">
        <h1 class="text-3xl font-bold text-gray-700 mb-8">Add New Book</h1>

        <form action="{{ route('books.store') }}" method="POST" class="bg-white shadow-lg rounded-lg p-6">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-semibold">Title</label>
                <input type="text" name="title" id="title" required class="border border-gray-300 rounded-lg p-2 w-full"
                    placeholder="Enter book title">
            </div>
            <div class="mb-4">
                <label for="author" class="block text-gray-700 font-semibold">Author</label>
                <input type="text" name="author" id="author" required
                    class="border border-gray-300 rounded-lg p-2 w-full" placeholder="Enter author's name">
            </div>
            <div class="mb-4">
                <label for="genre" class="block text-gray-700 font-semibold">Genre</label>
                <input type="text" name="genre" id="genre" required class="border border-gray-300 rounded-lg p-2 w-full"
                    placeholder="Enter genre">
            </div>
            <div class="mb-4">
                <label for="isbn" class="block text-gray-700 font-semibold">ISBN</label>
                <input type="text" name="isbn" id="isbn" required class="border border-gray-300 rounded-lg p-2 w-full"
                    placeholder="Enter ISBN number">
            </div>
            <div class="mb-4">
                <label for="quantity" class="block text-gray-700 font-semibold">Available Copies</label>
                <input type="number" name="quantity" id="quantity" required min="1"
                    class="border border-gray-300 rounded-lg p-2 w-full" placeholder="Enter number of copies">
            </div>
            <div class="mb-4">
                <button type="submit"
                    class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300">Add
                    Book</button>
            </div>
        </form>
    </div>
</section>

@endsection