@extends('layouts.layout')

@section('title', 'Books')

@section('content')
<!-- Books Section -->
<section class="py-20">
    <div class="container mx-auto px-6 lg:px-20">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-700">Books</h1>
            <div class="w-full md:w-1/3">
                <form action="{{ route('books.index') }}" method="GET">
                    <input name="search"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500 shadow focus:shadow-lg transition duration-300"
                        type="text" placeholder="Search for books..." value="{{ request()->input('search') }}" />
                </form>
            </div>
        </div>

        <!-- Book Table -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <table class="min-w-full bg-white">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">Title</th>
                        <th class="py-3 px-4 text-left">Author</th>
                        <th class="py-3 px-4 text-left">Genre</th>
                        <th class="py-3 px-4 text-left">ISBN</th>
                        <th class="py-3 px-4 text-left">Available Copies</th>
                        @if (auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role ===
                        'librarian' || auth()->user()->role === 'student'))
                        <th class="py-3 px-4 text-center">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                    <tr class="hover:bg-gray-100 transition duration-300">
                        <td class="py-3 px-4 border-b border-gray-200">{{ $book->title }}</td>
                        <td class="py-3 px-4 border-b border-gray-200">{{ $book->author }}</td>
                        <td class="py-3 px-4 border-b border-gray-200">{{ $book->genre }}</td>
                        <td class="py-3 px-4 border-b border-gray-200">{{ $book->isbn }}</td>
                        <td class="py-3 px-4 border-b border-gray-200">{{ $book->quantity }}</td>
                        @if (auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role ===
                        'librarian' || auth()->user()->role === 'student'))
                        <td class="py-3 px-4 border-b border-gray-200 text-center">
                            @if (auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role ===
                            'librarian'))
                            <a href="{{ route('books.edit', ['id' => $book->id]) }}"
                                class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600 transition duration-300">Edit</a>
                            <form action="{{ route('books.destroy', ['id' => $book->id]) }}" method="POST"
                                class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition duration-300">Delete</button>
                            </form>
                            @elseif (auth()->check() && auth()->user()->role === 'student')
                            <form action="{{ route('books.borrow', ['id' => $book->id]) }}" method="POST"
                                class="inline-block">
                                @csrf
                                <button type="submit"
                                    class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 transition duration-300">Borrow</button>
                            </form>
                            @endif
                        </td>

                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if (auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'librarian'))
        <div class="mt-6">
            <a href="{{ route('books.create') }}"
                class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300">Add New
                Book</a>
        </div>
        @endif
    </div>
</section>
@endsection

@if ($errors->any())
<div class="bg-red-500 text-white p-4 rounded-lg mb-4">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session('success'))
<div class="bg-green-500 text-white p-4 rounded-lg mb-4">
    {{ session('success') }}
</div>
@endif