<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Display a listing of users
    public function index()
    {
        $users = User::all(); // Fetch all users
        return view('users.index', compact('users')); // Return a view with the users
    }

    // Show the form for creating a new user
    public function create()
    {
        return view('users.create'); // Return a view to create a new user
    }

    // Store a newly created user
    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // Ensure password is confirmed
            'role' => 'required|in:admin,librarian,student',
        ]);

        // Create the user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']), // Hash the password
            'role' => $validatedData['role'],
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.'); // Redirect with success message
    }

    // Show the form for editing a user
    public function edit($id)
    {
        $user = User::findOrFail($id); // Find the user by ID
        return view('users.edit', compact('user')); // Return view with user data
    }

    // Update the specified user
    public function update(Request $request, $id)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|in:admin,librarian,student',
        ]);

        // Find the user
        $user = User::findOrFail($id);
        $user->update($validatedData); // Update user data

        return redirect()->route('users.index')->with('success', 'User updated successfully.'); // Redirect with success message
    }

    // Remove the specified user
    public function destroy($id)
    {
        $user = User::findOrFail($id); // Find the user
        $user->delete(); // Delete the user

        return redirect()->route('users.index')->with('success', 'User deleted successfully.'); // Redirect with success message
    }
}