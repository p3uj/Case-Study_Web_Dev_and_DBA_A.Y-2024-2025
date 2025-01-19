<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BarangayController;
use App\Http\Controllers\Api\CityController;
use App\Models\FindRoommateOrTenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

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

    // Insert data into the 'find_roommate_or_tenants' table in the database.
    public function store(Request $request) {
        $searchingPost = new FindRoommateOrTenant();
        $searchingPost->user_id = Auth::id();
        $searchingPost->date_posted = Carbon::now();
        $searchingPost->city = $request->city;
        $searchingPost->barangay = $request->barangay;
        $searchingPost->description = $request->description;
        $searchingPost->category_finding = (Auth::user()->role == 'Tenant' ? 'Roommate' : 'Tenant');

        if ($searchingPost->save()) {
            return redirect()->back();
        }

        return "Error occured";
    }
}
