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
        $user = User::getUserInfoById(Auth::id());

        $city = CityController::index();
        $barangay = BarangayController::index();

        // Use the User model to call the getAllFindingPosts() method to all the available find roommate or tenants posts
        $usersPosts = FindRoommateOrTenant::getAllFindingPosts();

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
        $city = $request->city; // city from the request
        $barangay = $request->barangay; // barangay from the request
        $description = $request->description; // description from the request
        $searchCategory = Auth::user()->role == 'Tenant' ? 'Roommate' : 'Tenant'; // search category based on the authenticated user role

        // Used a stored procedure to store the data
        DB::statement('EXEC RE_SP_INSERT_ROOMMATE_TENANT_POST ?, ?, ?, ?, ?', [
            $userId
            ,$city
            ,$barangay
            ,$description
            ,$searchCategory
        ]);

        return redirect()->back();
    }
}
