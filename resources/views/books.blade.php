<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Books | Library Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div>
                        <!-- Logo -->
                        <a href="/" class="flex items-center py-4 px-2">
                            <svg class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 20l9-5-9-5-9 5 9 5zM12 12l9-5-9-5-9 5 9 5z" />
                            </svg>
                            <span class="font-semibold text-gray-500 text-lg">Library Management System</span>
                        </a>
                    </div>
                    <!-- Primary Navbar items -->
                    <div class="hidden md:flex items-center space-x-1">
                        <a href="/"
                            class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300">Home</a>
                        <a href="#" class="py-4 px-2 text-blue-500 border-b-4 border-blue-500 font-semibold">Books</a>
                        @if (auth()->check() && auth()->user()->role === 'admin')
                        <a href="/users"
                            class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300">Users</a>
                        @endif
                    </div>
                </div>
                <!-- Secondary Navbar items -->
                <div class="hidden md:flex items-center space-x-3">
                    @if (auth()->check())
                    <span class="py-2 px-2 font-medium text-gray-500">{{ auth()->user()->name }}</span>
                    <a href="/logout"
                        class="py-2 px-2 font-medium text-gray-500 rounded hover:bg-red-500 hover:text-white transition duration-300">Logout</a>
                    @else
                    <a href="/login"
                        class="py-2 px-2 font-medium text-gray-500 rounded hover:bg-blue-500 hover:text-white transition duration-300">Login</a>
                    <a href="/signup"
                        class="py-2 px-2 font-medium text-white bg-blue-500 rounded hover:bg-blue-600 transition duration-300">Sign
                        Up</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Books Section -->
    <section class="py-20">
        <div class="container mx-auto px-6 lg:px-20">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-700">Books</h1>
                <div class="w-full md:w-1/3">
                    <input
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500 shadow focus:shadow-lg transition duration-300"
                        type="text" placeholder="Search for books..." />
                </div>
            </div>

            <!-- Define the books array in the view -->
            @php
            $books = [
            ['title' => 'The Great Gatsby', 'author' => 'F. Scott Fitzgerald', 'genre' => 'Fiction', 'isbn' =>
            '9780743273565', 'quantity' => 5],
            ['title' => 'To Kill a Mockingbird', 'author' => 'Harper Lee', 'genre' => 'Fiction', 'isbn' =>
            '9780061120084', 'quantity' => 3],
            ['title' => '1984', 'author' => 'George Orwell', 'genre' => 'Dystopian', 'isbn' => '9780451524935',
            'quantity' => 7],
            ['title' => 'Moby Dick', 'author' => 'Herman Melville', 'genre' => 'Adventure', 'isbn' => '9781503280786',
            'quantity' => 2],
            ];
            @endphp

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
                            <td class="py-3 px-4 border-b border-gray-200">{{ $book['title'] }}</td>
                            <td class="py-3 px-4 border-b border-gray-200">{{ $book['author'] }}</td>
                            <td class="py-3 px-4 border-b border-gray-200">{{ $book['genre'] }}</td>
                            <td class="py-3 px-4 border-b border-gray-200">{{ $book['isbn'] }}</td>
                            <td class="py-3 px-4 border-b border-gray-200">{{ $book['quantity'] }}</td>
                            @if (auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role ===
                            'librarian' || auth()->user()->role === 'student'))
                            <td class="py-3 px-4 border-b border-gray-200 text-center">
                                @if (auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role ===
                                'librarian'))
                                <a href="/books/{{ $loop->index }}/edit"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600 transition duration-300">Edit</a>
                                <form action="/books/{{ $loop->index }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition duration-300">Delete</button>
                                </form>
                                @elseif (auth()->check() && auth()->user()->role === 'student')
                                <a href="/borrow/{{ $loop->index }}"
                                    class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 transition duration-300">Borrow</a>
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
                <a href="/books/create"
                    class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300">Add
                    New
                    Book</a>
            </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6 fixed bottom-0 w-full">
        <div class="container mx-auto px-6 lg:px-20 text-center">
            <p>&copy; 2024 Library Management System. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>