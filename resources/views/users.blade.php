<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manage Users | Library Management System</title>
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
                        <a href="/users"
                            class="py-4 px-2 text-blue-500 border-b-4 border-blue-500 font-semibold">Users</a>
                    </div>
                </div>
                <!-- Secondary Navbar items -->
                <div class="hidden md:flex items-center space-x-3">
                    <a href="/logout"
                        class="py-2 px-2 font-medium text-gray-500 rounded hover:bg-red-500 hover:text-white transition duration-300">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- User Roles Management Section -->
    <section class="py-20">
        <div class="container mx-auto px-6 lg:px-20">
            <h1 class="text-3xl font-bold text-gray-700 mb-8">Manage User Roles</h1>

            <!-- User Table -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <table class="min-w-full bg-white">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="py-3 px-4 text-left">User</th>
                            <th class="py-3 px-4 text-left">Role</th>
                            <th class="py-3 px-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($users->isEmpty())
                        <tr>
                            <td colspan="3" class="py-3 px-4 text-center text-gray-500">
                                No users available.
                            </td>
                        </tr>
                        @else
                        @foreach ($users as $user)
                        <tr class="hover:bg-gray-100 transition duration-300">
                            <td class="py-3 px-4 border-b border-gray-200">{{ $user->name }}</td>
                            <td class="py-3 px-4 border-b border-gray-200">
                                <form action="/users/{{ $user->id }}/update-role" method="POST">
                                    @csrf
                                    <select name="role" onchange="this.form.submit()"
                                        class="border border-gray-300 rounded-lg p-1">
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin
                                        </option>
                                        <option value="librarian" {{ $user->role === 'librarian' ? 'selected' : '' }}>
                                            Librarian</option>
                                        <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>
                                            Student</option>
                                    </select>
                                </form>
                            </td>
                            <td class="py-3 px-4 border-b border-gray-200 text-center">
                                <form action="/users/{{ $user->id }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition duration-300">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
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