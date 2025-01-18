<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BarangayController;
use App\Http\Controllers\Api\CityController;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index() {
        // Call the index method in the CityController and BarangayController to fetch all the city and barangay list from external API
        $city = CityController::index();
        $barangay = BarangayController::index();

        return view('properties', [
            'cities' => $city
            ,'barangays' => $barangay
        ]);
    }
}
