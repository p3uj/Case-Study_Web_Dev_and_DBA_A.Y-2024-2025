<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UserProfileController;
use App\Models\FindRoommateOrTenant;
use App\Http\Controllers\Api\BarangayController;
use App\Http\Controllers\Api\CityController;
use App\Models\PropertyPost;
use App\Models\UnitPhotos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EditPropertyPostController extends Controller
{
    public function index($propertyPostId, $propertyInfoId) {
        $city = CityController::index();
        $barangay = BarangayController::index();

        // Call the
        $post = PropertyPost::getPropertyPostById($propertyInfoId);

        return view('EditForms.edit-property-post', [
            'propertyPostId' => $propertyPostId
            ,'propertyInfoId' => $propertyInfoId
            ,'cities' => $city
            ,'barangays' => $barangay
            ,'post' => $post
        ]);
    }

    public function update(Request $request) {
        // Check if unit category is different from the default, set null if same
        $unitCategory = ($request->input('unit-category') == $request->input('default-unit-category')) ? null : $request->input('unit-category');

        // Check if city is different from the default, set null if same
        $city = ($request->city == $request->input('default-city')) ? null : $request->city;

        // Check if barangay is different from the default, set null if same
        $barangay = ($request->barangay == $request->input('default-barangay')) ? null : $request->barangay;

        // Check if unit category is different from the default, set null if same
        $rentalPrice = ($request->input('rental-price') == $request->input('default-rental-price')) ? null : $request->input('rental-price');

        // Check if unit category is different from the default, set null if same
        $maxOccupancy = ($request->input('max-occupancy') == $request->input('default-max-occupancy')) ? null : $request->input('max-occupancy');

        // Check if description is different from the default, set null if same
        $description = ($request->description == $request->input('default-description')) ? null : $request->description;

        // Used a stored procedure to store the data
        DB::statement('RE_SP_UPDATE_PROPERTY_POST_AND_INFO_BY_ID ?, ?, ?, ?, ?, ?, ?, ?', [
            $request->input('property-post-id')
            ,$request->input('property-info-id')
            ,$unitCategory
            ,$city
            ,$barangay
            ,$rentalPrice
            ,$maxOccupancy
            ,$description
        ]);

        return redirect()->route('user-profile');
    }

    public function delete($id, $available, $deleted) {
        // Set to null if the value of available and deleted is 'null'
        $available = $available != "null" ? $available : null;
        $deleted = $deleted != "null" ? $deleted : null;

        // Update only the is_deleted column in the database
        if (!is_null($deleted)) {
            // Used a stored procedure to store the data
            DB::statement('RE_SP_UPDATE_PROPERTY_POST_AND_INFO_BY_ID ?, ?, ?, ?, ?, ?, ?, ?, ?, ?', [
                null
                ,$id
                ,null
                ,null
                ,null
                ,null
                ,null
                ,null
                ,$available
                ,$deleted
            ]);
        }

        return redirect()->back();
    }
}
