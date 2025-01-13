<?php

namespace App\Http\Controllers;

use App\Models\FindRoommateOrTenant;
use App\Models\PropertyInfo;
use App\Models\PropertyPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserProfileController extends Controller
{
    private function propertyPost() {
        // Call the PropertyPost model to get the property posts of the authenticated user
        $propertyPost = PropertyPost::getUserPropertyPost();

        return $propertyPost;
    }

    private function findRoommateOrTenantPost() {
        // Call the FindRoommateOrTenant model to fetch posts for the authenticated user
        $findPost = FindRoommateOrTenant::getAuthUserFindingPost();

        return $findPost;
    }

    public function index() {
        // Call the getUserAuthInfo method in the User model to fetch the info of the authenticated user
        $userInfo = User::getUserAuthInfo();

        // Call the propertyPost method to fetch the property post of an authenticated user
        $properties = $this->propertyPost();

        // Call the findRoommateOrTenantPost() method to fetch the post for the authenticated user
        $findingPost = $this->findRoommateOrTenantPost();

        return view('user-profile', [
            'user' => $userInfo
            ,'propertyPost' => $properties
            ,'findPost' => $findingPost
        ]);
    }
}
