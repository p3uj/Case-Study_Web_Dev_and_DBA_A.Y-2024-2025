<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BarangayController;
use App\Http\Controllers\Api\CityController;
use App\Models\PropertyPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    private $city;
    private $barangay;

    public function __construct()
    {
        // Call the index method in the city and barangay controller to fetch the data from external API and assign to the properties of the class
        $this->city = CityController::index();
        $this->barangay = BarangayController::index();
    }

    public function index() {
        // Call the getAllFilteredPropertyPosts method in the PropertyPost model, passing the 'Dormitories' as a parameter
        $propertyPosts = PropertyPost::getAllFilteredPropertyPosts("Dormitories");

        // Set the default value of filter search
        $filterSearch = [
            'filter-unit-category' => 'Dormitories'
            ,'city' => null
            ,'filter-rental-price' => null
        ];

        $userRole = Auth::user()->role;   // Get the role of the authenticated user
        return view('properties', [
            'cities' => $this->city
            ,'barangays' => $this->barangay
            ,'propertyPosts' => $propertyPosts
            ,'filterSearch' => $filterSearch
            ,'userRole' => $userRole
        ]);
    }

    public function storeOrFilterSearch(Request $request) {
        // Check if the request has filter unit category field
        if ($request->has('filter-unit-category')) {
            // Get the filtered property posts based on the criteria in the request
            $filteredPropertyPosts = PropertyPost::getAllFilteredPropertyPosts($request->input('filter-unit-category'), $request->city, $request->input('filter-rental-price'));

            return view('properties', [
                'cities' => $this->city
                ,'barangays' => $this->barangay
                ,'filterSearch' => $request->only(['filter-unit-category', 'city', 'filter-rental-price']) // Only return these fields from the request
                ,'propertyPosts' => $filteredPropertyPosts
            ]);
        }

        return $this->store($request); // Call the store method to store the request data in the database
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

        // Save the uploaded photos in the desired folder
        foreach ($uploadedFiles as $file) {
            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->storeAs("uploads/images/property-posts", $fileName, "public"); // Store the file in the desired folder
        }

        return redirect()->back();
    }
}
