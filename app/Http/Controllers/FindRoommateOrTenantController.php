<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BarangayController;
use App\Http\Controllers\Api\CityController;
use App\Models\FindRoommateOrTenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FindRoommateOrTenantController extends Controller
{
    public function index(){
        // Call the getUserAuthInfo method in the User model with the id of the authenticated user to retrieve its info
        $user = User::getUserAuthInfo(Auth::id());

        $city = CityController::index();
        $barangay = BarangayController::index();

        // Use the User model to call the getAllFindingPostsWithUser() method to get user info and their related posts
        $usersPosts = FindRoommateOrTenant::getAllFindingPostsWithUser();

        return view('find-roommate-or-tenant', [
            'user' => $user
            ,'cities' => $city
            ,'barangays' => $barangay
            ,'posts' => $usersPosts
        ]);
    }

    // Insert data into the 'find_roommate_or_tenants' table in the database
    public function store(Request $request) {
        // Extracting the variables for clarity and readability
        $userId = Auth::id(); // Id of the authenticated user
        $datePosted = Carbon::now(); // Current date and time
        $city = $request->city; // city from the request
        $barangay = $request->barangay; // barangay from the request
        $description = $request->description; // description from the request
        $categoryFinding = Auth::user()->role == 'Tenant' ? 'Roommate' : 'Tenant'; // category finding based on the authenticated user role

        // Used a stored procedure to store the data
        DB::statement('EXEC StoreSearchingPost ?, ?, ?, ?, ?, ?', [
            $userId
            ,$datePosted
            ,$city
            ,$barangay
            ,$description
            ,$categoryFinding
        ]);

        return redirect()->back();
    }
}
