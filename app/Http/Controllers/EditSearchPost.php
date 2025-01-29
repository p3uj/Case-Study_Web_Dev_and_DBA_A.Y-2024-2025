<?php

namespace App\Http\Controllers;

use App\Models\FindRoommateOrTenant;
use App\Http\Controllers\Api\BarangayController;
use App\Http\Controllers\Api\CityController;
use App\Models\PropertyPost;
use App\Models\UnitPhotos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EditSearchPost extends Controller
{
    public function index($id) {
        $city = CityController::index();
        $barangay = BarangayController::index();

        // Call the
        $post = FindRoommateOrTenant::getRoommateTenantPostsById($id);

        return view('EditForms.edit-find-roommate-tenant-post', [
            'id' => $id
            ,'cities' => $city
            ,'barangays' => $barangay
            ,'post' => $post
        ]);
    }

    public function update(Request $request) {
        dd($request);
        // Check if city is different from the default, set null if same
        $city = ($request->city == $request->input('default-city')) ? null : $request->city;

        // Check if barangay is different from the default, set null if same
        $barangay = ($request->barangay == $request->input('default-barangay')) ? null : $request->barangay;

        // Check if description is different from the default, set null if same
        $description = ($request->description == $request->input('default-description')) ? null : $request->description;

        // Used a stored procedure to store the data
        DB::statement('RE_UPDATE_ROOMMATE_TENANT_POST ?, ?, ?, ?', [
            $request->id
            ,$city
            ,$barangay
            ,$description
        ]);

        return redirect()->back();
    }

    public function updateFoundOrDelete($id, $found, $deleted) {
        // Set to null if the value of found and deleted is 'null'
        $found = $found != "null" ? $found : null;
        $deleted = $found != "null" ? $deleted : null;

        // Update only the is_alrady_found column in the database if the value of $found is not null
        if (!is_null($found)) {
            // Used a stored procedure to store the data
            DB::statement('RE_UPDATE_ROOMMATE_TENANT_POST ?, ?, ?, ?, ?', [
                $id
                ,null
                ,null
                ,null
                ,$found
            ]);
        } else {
            // Update only the is_deleted column in the database
            // Used a stored procedure to store the data
            DB::statement('RE_UPDATE_ROOMMATE_TENANT_POST ?, ?, ?, ?, ?, ?', [
                $id
                ,null
                ,null
                ,null
                ,null
                ,$deleted
            ]);
        }

        return redirect()->back();
    }
}
