<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Library Management System')</title>
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
                            class="py-4 px-2 {{ request()->is('/') ? 'text-blue-500 border-b-4 border-blue-500 font-semibold' : 'text-gray-500 font-semibold hover:text-blue-500 transition duration-300' }}">Home</a>
                        <a href="/books"
                            class="py-4 px-2 {{ request()->is('books') ? 'text-blue-500 border-b-4 border-blue-500 font-semibold' : 'text-gray-500 font-semibold hover:text-blue-500 transition duration-300' }}">Books</a>
                        <!-- Only students and Librarians can see the Borrowed Books link -->
                        @if (auth()->check() && (auth()->user()->role === 'librarian' || auth()->user()->role ===
                        'student'))
                        <a href="/borrowed-books"
                            class="py-4 px-2 {{ request()->is('borrowed-books') ? 'text-blue-500 border-b-4 border-blue-500 font-semibold' : 'text-gray-500 font-semibold hover:text-blue-500 transition duration-300' }}">Borrowed
                            Books</a>
                        @endif
                        <!-- Only admin can see the Users link -->
                        @if (auth()->check() && auth()->user()->role === 'admin')
                        <a href="/users"
                            class="py-4 px-2 {{ request()->is('users') ? 'text-blue-500 border-b-4 border-blue-500 font-semibold' : 'text-gray-500 font-semibold hover:text-blue-500 transition duration-300' }}">Users</a>
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
                        class="py-2 px-2 font-medium {{ request()->is('login') ? 'bg-blue-500 rounded hover:bg-blue-600 transition duration-300 text-white' : 'rounded hover:bg-blue-500 hover:text-white transition duration-300 text-gray-500' }}">Login</a>
                    <a href="/signup"
                        class="py-2 px-2 font-medium {{ request()->is('signup') ? 'text-white bg-blue-500 rounded hover:bg-blue-600 transition duration-300' : 'rounded hover:bg-blue-500 hover:text-white transition duration-300 text-gray-500' }}">Sign
                        Up</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto px-6 lg:px-20 text-center">
            <p>&copy; 2024 Library Management System. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>