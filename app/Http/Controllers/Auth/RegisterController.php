<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Api\CityController;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        // Fetch cities to populate the registration form
        $cities = CityController::index(); // Assuming this returns an array of cities

        return view('auth.register', ['cities' => $cities]);
    }

    /**
     * Handle the registration process.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validate the form data
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:Tenant,Landlord',
        ]);

        // Set the bio based on the role
        $bio = $request->input('role') === 'Landlord'
            ? 'Landlord managing multiple properties.'
            : 'Tenant looking for affordable housing.';

        // Hash the password
        $hashedPassword = Hash::make($request->input('password'));

        // Define the default profile photo path
        $profilePhotoPath = "/resources/images/sampleProfile.png";

        // Call the stored procedure to insert the user
        DB::statement('
            EXEC SP_INSERT_USER 
                @u_role = ?, 
                @u_firstname = ?, 
                @u_lastname = ?, 
                @u_city = ?, 
                @u_email = ?, 
                @u_password = ?, 
                @u_profile_photo_path = ?, 
                @u_bio = ?',
            [
                $request->input('role'),
                $request->input('firstname'),
                $request->input('lastname'),
                $request->input('city'),
                $request->input('email'),
                $hashedPassword,
                $profilePhotoPath,
                $bio,
            ]
        );

        // Find the newly created user by email
        $user = DB::table('users')->where('email', $request->input('email'))->first();

        // Log the user in
        if ($user) {
            Auth::loginUsingId($user->id);

            // Store user ID and role in session
            session([
                'user_id' => $user->id,
                'role' => $user->role
            ]);
        }

        // Redirect to the homepage or dashboard
        return redirect()->route('homepage'); // Adjust this to your needs
    }
}