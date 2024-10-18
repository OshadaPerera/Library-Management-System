@extends('layouts.layout')

@section('title', 'Users')

@section('content')

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
                    @php
                    // Sample users array
                    $users = [
                    (object)[
                    'id' => 1,
                    'name' => 'John Doe',
                    'role' => 'admin'
                    ],
                    (object)[
                    'id' => 2,
                    'name' => 'Jane Smith',
                    'role' => 'librarian'
                    ],
                    (object)[
                    'id' => 3,
                    'name' => 'Emily Johnson',
                    'role' => 'student'
                    ],
                    (object)[
                    'id' => 4,
                    'name' => 'Michael Brown',
                    'role' => 'student'
                    ]
                    ];
                    @endphp

                    @if (empty($users))
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
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="librarian" {{ $user->role === 'librarian' ? 'selected' : '' }}>
                                        Librarian</option>
                                    <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>Student
                                    </option>
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

@endsection