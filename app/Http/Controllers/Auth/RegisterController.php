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

        // Define the default profile photo path
        $profilePhotoPath = asset("/resources/images/sampleProfile.png");

        // Call the stored procedure to insert the user
        DB::statement('EXEC RE_SP_INSERT_USER ?, ?, ?, ?, ?, ?, ?, ?', [
                $request->input('role'),
                $request->input('firstname'),
                $request->input('lastname'),
                $request->input('city'),
                $request->input('email'),
                Hash::make($request->input('password')),
                $profilePhotoPath,
                $bio,
            ]
        );

        // Use the stored procedure to find the newly created user by email
        $user = DB::select('EXEC RE_SP_GET_USER_INFO_BY_ID_AND_USER_BY_EMAIL ?, ?', [null, $request->input('email')]);

        // Log the user in if found
        if (!empty($user)) {
            $user = $user[0]; // Fetch the first record since DB::select returns an array
            Auth::loginUsingId($user->user_id);

            // Store user ID and role in session
            session([
                'user_id' => $user->user_id,
                'role' => $user->role
            ]);
        }
        // Flash success message
        session()->flash('success', 'Registration successful! Welcome to RentEase!');

        return back();
    }
}
