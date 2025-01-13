<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BarangayController;
use App\Http\Controllers\Api\CityController;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function showCityList(){
        // Call the CityController to fetch the data from the external API
        $cities = CityController::index();

        return view('properties', [
            'cities' => $cities,
        ]);
    }
}
