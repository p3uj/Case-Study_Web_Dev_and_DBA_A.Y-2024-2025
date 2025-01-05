<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\CityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FindRommateOrTenantController extends Controller
{
    public function userInfo(){
        return view('user-profile', [
            'user' => Auth::user()
        ]);
    }

    public function showCityList(){
        // Call the CityController to fetch the data from the external API
        $cities = CityController::index();
        //$barangays = BarangayController::index();

        return view('find-roommate-or-tenant', [
            'user' => Auth::user(),
            'cities' => $cities,
            //'barangays' => $barangays
        ]);
    }
}
