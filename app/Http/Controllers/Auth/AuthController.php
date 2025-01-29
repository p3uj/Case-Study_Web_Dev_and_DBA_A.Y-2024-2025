<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // Retrieve the user's details using the stored procedure
        $userDetails = DB::select('EXEC RE_SP_GET_USER_INFO_BY_ID_AND_USER_BY_EMAIL ?, ?', [null, $request->input('email')]);

        // Check if user exists
        $user = $userDetails[0] ?? null;
        if (!$user) {
            // Redirect to registration with a recommendation to create an account
            return redirect(route("login"))
                ->with("info", "Email not found. Please create an account.");
        }
        else {
            // Verify the password
            if (password_verify($request->input('password'), $user->password)) {
                // Log the user in manually
                Auth::loginUsingId($user->user_id);

                // Store user details in session
                session([
                    'user_id' => $user->user_id,
                    'role' => $user->role,
                ]);

                return redirect()->intended(route("homepage"));
            }
        }

        // If the credentials are incorrect, show an error and redirect to login page.
        return redirect(route("login"))
            ->with("error", "Invalid email or password. Please try again.");
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
}
