<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException; // Import QueryException
use Exception; // Import the base Exception class

class AuthController extends Controller
{
    // Show the signup form
    public function showSignup()
    {
        return view('signup'); // Return the signup view
    }

    // Handle signup request
    public function signup(Request $request)
    {
        try {
            // Validate the request
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed', // Ensure password is confirmed
            ]);
    
            // Create the user
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']), // Hash the password
                'role' => 'student', // Default role
            ]);
    
            return redirect('/login')->with('success', 'Account created successfully. You can now log in.'); // Redirect to login
            
        } catch (QueryException $e) {
            // Handle specific database-related exceptions
            return redirect('/signup')->withErrors('Database error: ' . $e->getMessage())->withInput();
        } catch (Exception $e) {
            // Handle general exceptions
            return redirect('/signup')->withErrors('An error occurred: ' . $e->getMessage())->withInput();
        }
    }
    

    // Show the login form
    public function showLogin()
    {
        return view('login'); // Return the login view
    }

    // Handle login request
    public function login(Request $request)
    {
        try {
            // Validate the request
            $validatedData = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            // Attempt to log the user in
            if (Auth::attempt($validatedData)) {
                return redirect('/')->with('success', 'Logged in successfully.'); // Redirect to dashboard
            }

            return redirect('/login')->withErrors('Invalid credentials.'); // Redirect back with error
            
        } catch (Exception $e) {
            // Handle any exceptions that may occur
            return redirect('/login')->withErrors('An error occurred: ' . $e->getMessage());
        }
    }

    // Handle logout
    public function logout()
    {
        Auth::logout(); // Log out the user
        return redirect('/login')->with('success', 'Logged out successfully.'); // Redirect to login
    }
}