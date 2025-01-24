<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BarangayController;
use App\Http\Controllers\Api\CityController;
use App\Models\PropertyPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    public function index() {
        // Call the index method in the CityController and BarangayController to fetch all the city and barangay list from external API
        $city = CityController::index();
        $barangay = BarangayController::index();
        $propertyPosts = PropertyPost::getAllPropertyPostByFilterSearch("Dormitories");

        // Set the default value of filter search
        $filterSearch = [
            'filter-unit-category' => 'Dormitories'
            ,'city' => null
            ,'filter-rental-price' => null
        ];

        return view('properties', [
            'cities' => $city
            ,'barangays' => $barangay
            ,'propertyPosts' => $propertyPosts
            ,'filterSearch' => $filterSearch
        ]);
    }

    // Create Property Post on the database
    public function store(Request $request) {
        $photoNameString = ""; // Use to store all the original file name since the stored procedure only accepts a string as a parameter

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
            $photoNameString .= '"' . time() . '_' . $file->getClientOriginalName() . '", '; // Add quotes around each name and a comma to make it easier to convert to JSON format in the stored procedure.
        }

        // Remove the trailing comma and space at the end of the string
        $photoNameString = rtrim($photoNameString, ', ');

        // Used a stored procedure to store the data
        DB::statement('RE_SP_INSERT_PROPERTY_POST_WITH_RELATIONS ?, ?, ?, ?, ?, ?, ?, ?', [
            $city
            ,$barangay
            ,$unitCategory
            ,$rentalPrice
            ,$maxOccupancy
            ,$description
            ,$photoNameString
            ,$userId
        ]);

        // Save the uploaded photos in public folder
        foreach ($uploadedFiles as $file) {
            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('uploads/images/property-posts'), $fileName); // Move the file in the desired folder
        }

        return redirect()->back();
    }

    public function filterSearch(Request $request) {
        // Get the filtered property posts based on the criteria in the request
        $propertyPosts = PropertyPost::getAllPropertyPostByFilterSearch($request->input('filter-unit-category'), $request->city, $request->input('filter-rental-price'));

        // Retrieve the list of cities and barangays to pass them along with the filtered property posts
        $city = CityController::index();
        $barangay = BarangayController::index();

        // Redirect back to the 'properties' page with updated data
        return view('properties', [
            'cities' => $city
            ,'barangays' => $barangay
            ,'propertyPosts' => $propertyPosts
            ,'filterSearch' => $request
        ]);
    }
}
