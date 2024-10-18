<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Library Management System</title>
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
                        <a href="#" class="flex items-center py-4 px-2">
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
                        <a href="/books"
                            class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300">Books</a>
                        <!-- Only admin can see the Users link -->
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
                        class="py-2 px-2 font-medium text-white bg-blue-500 rounded hover:bg-blue-600 transition duration-300">Login</a>
                    <a href="/signup"
                        class="py-2 px-2 font-medium text-gray-500 rounded hover:bg-blue-500 hover:text-white transition duration-300">Sign
                        Up</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Login Section -->
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold text-center text-gray-700">Login</h2>
            <form action="/login" method="POST" class="mt-6">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" name="email" id="email"
                        class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password"
                        class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>
                <div class="flex items-center justify-between">
                    <a href="#" class="text-sm text-blue-500 hover:underline">Forgot password?</a>
                </div>
                <div class="mt-6">
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                        Login
                    </button>
                </div>
            </form>
            <p class="mt-6 text-center text-gray-600">
                Don't have an account? <a href="/signup" class="text-blue-500 hover:underline">Sign up</a>
            </p>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto px-6 lg:px-20 text-center">
            <p>&copy; 2024 Library Management System. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>