<?php

namespace App\Http\Controllers;

use App\Models\FindRoommateOrTenant;
use App\Http\Controllers\Api\BarangayController;
use App\Http\Controllers\Api\CityController;
use App\Models\PropertyPost;
use App\Models\UnitPhotos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EditProfileController extends Controller
{
    public function index($id) {
        $city = CityController::index();

        // Call the
        $userInfo = User::getUserInfoById($id);

        return view('EditForms.edit-profile', [
            'id' => $id
            ,'cities' => $city
            ,'userInfo' => $userInfo
        ]);
    }

    public function update(Request $request) {
        // Check if firtname is different from the default, set null if same
        $first = ($request->firstname == $request->input('default-firstname')) ? null : $request->firstname;

        // Check if firtname is different from the default, set null if same
        $lastname = ($request->lastname == $request->input('default-lastname')) ? null : $request->lastname;

        // Check if city is different from the default, set null if same
        $city = ($request->city == $request->input('default-city')) ? null : $request->city;

        // Check if description is different from the default, set null if same
        $bio = ($request->bio == $request->input('default-bio')) ? null : $request->bio;

        // Check if description is different from the default, set null if same
        $profilePhoto = ($request->input('profile-photo-path') == $request->input('default-profile-photo-path')) ? null : $request->input('profile-photo-path');

        if ($profilePhoto) {

        }

        // Used a stored procedure to store the data
        DB::statement('RE_SP_UPDATE_USERINFO ?, ?, ?, ?, ?, ?', [
            $request->id
            ,$first
            ,$lastname
            ,$city
            ,$bio
            ,$profilePhoto
        ]);

        // Save the

        return redirect()->route('userprofilepage');
    }
}
