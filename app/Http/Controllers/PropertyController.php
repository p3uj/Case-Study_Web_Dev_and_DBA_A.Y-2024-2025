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

    // Create Property Post on the database
    public static function store(Request $request) {
        //dd($request->file('images'));
        $uploadedFiles = $request->file('images'); // Retrieve all the uploaded files

        $photoPath = []; // Use to store all the original file name
        // Extract the original name of the files
        foreach ($uploadedFiles as $file) {
            $photoPath[] = $file->getClientOriginalName(); // Store the original name
        }

        //dd($photoPath);
        return $photoPath;
    }
}
