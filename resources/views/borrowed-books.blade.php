@extends('layouts.layout')

@section('title', 'Borrowed Books')

@section('content')
<section class="py-20">
    <div class="container mx-auto px-6 lg:px-20">
        <h1 class="text-3xl font-bold text-gray-700 mb-8">Borrowed Books</h1>

        <!-- Search Bar -->
        <div class="mb-6">
            <input type="text" id="searchInput" placeholder="Search by book name..."
                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500 shadow focus:shadow-lg transition duration-300">
        </div>

        <!-- Define the borrowed_books array in the view -->
        @php
        $borrowedBooks = [
        // Example data
        ['book_title' => 'The Great Gatsby', 'user_name' => 'John Doe', 'borrowed_at' => '2024-10-01', 'due_date' =>
        '2024-10-15', 'returned_at' => null, 'penalty_amount' => 0],
        ['book_title' => '1984', 'user_name' => 'Jane Smith', 'borrowed_at' => '2024-10-05', 'due_date' => '2024-10-12',
        'returned_at' => null, 'penalty_amount' => 5],
        // Add more borrowed books for testing
        ];
        @endphp

        <!-- Borrowed Books Table -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <table class="min-w-full bg-white">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">Book Title</th>
                        <th class="py-3 px-4 text-left">Borrowed By</th>
                        <th class="py-3 px-4 text-left">Borrowed At</th>
                        <th class="py-3 px-4 text-left">Due Date</th>
                        <th class="py-3 px-4 text-left">Returned</th>
                        <th class="py-3 px-4 text-left">Penalty</th>
                    </tr>
                </thead>
                <tbody id="borrowedBooksTable">
                    @foreach ($borrowedBooks as $borrowedBook)
                    <tr class="hover:bg-gray-100 transition duration-300">
                        <td class="py-3 px-4 border-b border-gray-200">{{ $borrowedBook['book_title'] }}</td>
                        <td class="py-3 px-4 border-b border-gray-200">{{ $borrowedBook['user_name'] }}</td>
                        <td class="py-3 px-4 border-b border-gray-200">{{ $borrowedBook['borrowed_at'] }}</td>
                        <td class="py-3 px-4 border-b border-gray-200">{{ $borrowedBook['due_date'] }}</td>
                        <td class="py-3 px-4 border-b border-gray-200">
                            {{ $borrowedBook['returned_at'] ? 'Yes' : 'No' }}
                        </td>
                        <td class="py-3 px-4 border-b border-gray-200">
                            @if (!$borrowedBook['returned_at'] &&
                            \Carbon\Carbon::now()->greaterThan($borrowedBook['due_date']))
                            <span class="text-red-500">{{ $borrowedBook['penalty_amount'] }} (Penalty)</span>
                            @else
                            <span class="text-green-500">No Penalty</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<script>
// Search Functionality
document.getElementById('searchInput').addEventListener('keyup', function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll('#borrowedBooksTable tr');

    rows.forEach(row => {
        let titleCell = row.cells[0].textContent.toLowerCase();
        if (titleCell.includes(filter)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>
@endsection