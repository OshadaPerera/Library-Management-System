@extends('layouts.layout')


@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="parallax-bg text-white py-20">
    <div class="container mx-auto px-6 lg:px-20 text-center">
        <h1 class="text-5xl font-extrabold mb-4">Explore the World of Knowledge</h1>
        <p class="mb-8 text-lg">Seamless management of users, books, and borrowing activities.</p>
        <a href="/books"
            class="bg-white text-blue-600 py-3 px-6 rounded-full text-lg hover:bg-gray-200 transition duration-300 animate-bounce-slow">Browse
            Books</a>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6 lg:px-20">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold">Amazing Features</h2>
            <p class="text-gray-600">Discover what makes our library management system stand out.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <!-- Feature 1 -->
            @if (auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'librarian'))
            <div class="text-center p-8 bg-gray-100 shadow-lg rounded-lg hover-scale">
                <svg class="h-14 w-14 text-blue-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 9V5a2 2 0 00-2-2H6a2 2 0 00-2 2v4m0 0v10a2 2 0 002 2h8a2 2 0 002-2V9m-6 4h.01" />
                </svg>
                <h3 class="text-2xl font-semibold mb-2">Manage Books</h3>
                <p class="text-gray-600">Easily add, update, and remove books.</p>
            </div>
            @endif

            <!-- Feature 2 -->
            @if (auth()->check() && auth()->user()->role === 'student')
            <div class="text-center p-8 bg-gray-100 shadow-lg rounded-lg hover-scale">
                <svg class="h-14 w-14 text-blue-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m5-4v8" />
                </svg>
                <h3 class="text-2xl font-semibold mb-2">Borrow & Return</h3>
                <p class="text-gray-600">Seamlessly borrow and return books on time.</p>
            </div>
            @endif

            <!-- Feature 3 -->
            @if (auth()->check() && auth()->user()->role === 'admin')
            <div class="text-center p-8 bg-gray-100 shadow-lg rounded-lg hover-scale">
                <svg class="h-14 w-14 text-blue-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12h2m-6 4H9m-6-4h2m10-6H7m6 0h2" />
                </svg>
                <h3 class="text-2xl font-semibold mb-2">User Management</h3>
                <p class="text-gray-600">Admins can efficiently manage users.</p>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection


<style>
/* Parallax scrolling effect for the hero background */
.parallax-bg {
    background-image: url('https://miro.medium.com/v2/resize:fit:1200/1*6Jp3vJWe7VFlFHZ9WhSJng.jpeg');
    /* Replace with a library-themed image */
    background-attachment: fixed;
    background-size: cover;
    background-position: center;
}

.hover-scale {
    transition: transform 0.3s;
}

.hover-scale:hover {
    transform: scale(1.05);
}

.animate-bounce-slow {
    animation: bounce 2s infinite;
}
</style>