<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BarangayController;
use App\Http\Controllers\Api\CityController;
use App\Models\FindRoommateOrTenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FindRommateOrTenantController extends Controller
{
    public function index(){
        // Call the getUserAuthInfo() method in the User model to retrieve the authenticated user's information
        $user = User::getUserAuthInfo();

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
}
