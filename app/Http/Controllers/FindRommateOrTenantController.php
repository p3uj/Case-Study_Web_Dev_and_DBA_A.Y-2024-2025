<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\CityController;
use App\Models\FindRoommateOrTenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FindRommateOrTenantController extends Controller
{
    private function showCityList(){
        // Call the CityController to fetch the data from the external API
        $cities = CityController::index();

        return $cities;
    }

    public function index(){
        // Call the getUserAuthInfo() method in the User model to retrieve the authenticated user's information
        $user = User::getUserAuthInfo();

        // Call the showCityList() method to fetch the city
        $cityList = $this->showCityList();

        // Use the User model to call the getUserInfoAndItsFindingPost() method to get user info and their related posts
        $usersPosts = FindRoommateOrTenant::getUserInfoAndItsFindingPost();

        return view('find-roommate-or-tenant', [
            'user' => $user
            ,'cities' => $cityList
            ,'posts' => $usersPosts
        ]);
    }
}
