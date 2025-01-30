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

class SearchUserResultController extends Controller
{
    public function index($request) {
        $user = User::searchUserResult($request->input('search-user'));

        return view('search-user-result', [
            //'user' => $user
            'users' => $user
        ]);
    }

    public function fetchUser(Request $request) {
        return $this->index($request);
    }
}
