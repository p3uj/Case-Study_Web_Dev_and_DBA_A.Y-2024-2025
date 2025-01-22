<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BarangayController;
use App\Http\Controllers\Api\CityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $photoPathString = ""; // Use to store all the original file name since the stored procedure only accepts a string as a parameter

        // Extracting the variables for clarity and readability
        $city = $request->city; // City from request
        $barangay = $request->barangay; // Barangay from request
        $unitCategory = $request->input('unit-category'); // Unit category from request
        $rentalPrice = $request->input('rental-price'); // Rental price from request
        $maxOccupancy = $request->input('max-occupancy'); // Max occupancy from request
        $description = $request->description; // Description from request
        $userId = Auth::id(); // Id of the authenticated user

        $uploadedFiles = $request->file('images'); // Retrieve all the uploaded files

        // Extract the original name of the files and store in a single string
        foreach ($uploadedFiles as $file) {
            $photoPathString .= '"' . $file->getClientOriginalName() . '", '; // Add quotes around each name and a comma to make it easier to convert to JSON format in the stored procedure.
        }

        // Remove the trailing comma and space at the end of the string
        $photoPathString = rtrim($photoPathString, ', ');

        // Used a stored procedure to store the data
        DB::statement('RE_SP_INSERT_PROPERTY_POST_WITH_RELATIONS ?, ?, ?, ?, ?, ?, ?, ?', [
            $city
            ,$barangay
            ,$unitCategory
            ,$rentalPrice
            ,$maxOccupancy
            ,$description
            ,$photoPathString
            ,$userId
        ]);

        return redirect()->back();
    }
}
