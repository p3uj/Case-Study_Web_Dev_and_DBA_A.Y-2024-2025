<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        // If the user is already authenticated, redirect to the home page.
        if (Auth::check()) {
            return redirect(route("homepage"));
        }
        return view("auth.login");
    }

    public function loginpost(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);
        
        $credentials = $request->only("email", "password");

        // If the user entered correct credentials, redirect to home page.
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route("homepage"));
        }

        // If the credentials are incorrect, show error and redirect to login page.
        return redirect(route("login"))->with("error", "Login failed");
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect(route("login"));
    }

    // Show the registration form
    public function showRegisterForm()
    {
        return view('auth.register');  // Ensure you have a 'register' view
    }

    // Handle the registration form submission
    public function register(Request $request)
    {
        // Validate the registration form data
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // Make sure the passwords match
            'role' => 'required|in:tenant,landlord', // Validate role field
        ]);

        // Create a new user in the database
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,  // Save the role
        ]);

        // Log the user in automatically after registration
        Auth::login($user);

        // Redirect to the homepage or wherever needed after successful registration
        return redirect()->route('homepage');
    }
}
