@extends('layouts.layout')

@section('title', 'Login')

@section('content')
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
@endsection