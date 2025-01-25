<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BarangayController;
use App\Http\Controllers\Api\CityController;
use App\Models\FindRoommateOrTenant;
use App\Models\PropertyInfo;
use App\Models\PropertyPost;
use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserProfileController extends Controller
{
    private function propertyPost($userId) {
        // Call the PropertyPost model to get the property posts of the authenticated user
        $propertyPost = PropertyPost::getPropertyPostsByUserId($userId);

        return $propertyPost;
    }

    private function findRoommateOrTenantPost($userId) {
        // Call the FindRoommateOrTenant model to fetch posts for the authenticated user
        $findPost = FindRoommateOrTenant::getAllRoommateTenantPostsByUserId($userId);

        return $findPost;
    }

    private function reviewsReceivedByUserId($userId) {
        // Call the getAllReviewsForAuthUser() method in the Reviews model to fetch all the reviews that received by authenticated user
        $reviewReceived = Reviews::getAllReviewsForAUser($userId);

        return $reviewReceived;
    }

    public function index() {
        // Call the index method of the city and barangay controller to get the data
        $city = CityController::index();
        $barangay = BarangayController::index();

        // Call the getUserAuthInfo method in the User model with the id of the authenticated user to fetch its info
        $userInfo = User::getUserInfoById(Auth::id());

        // Call the propertyPost method with authenticated user id to fetch the property post of an authenticated user
        $properties = $this->propertyPost(Auth::id());

        // Call the findRoommateOrTenantPost() method to fetch the post for the authenticated user
        $findingPost = $this->findRoommateOrTenantPost(Auth::id());

        // Call the reviewsReceivedByAuthUser() method to fetch all the reviews that the authenticated user received
        $reviews = $this->reviewsReceivedByUserID(Auth::id());

        return view('user-profile', [
            'user' => $userInfo
            ,'propertyPost' => $properties
            ,'findPost' => $findingPost
            ,'reviews' => $reviews
            ,'cities' => $city
            ,'barangays' => $barangay
        ]);
    }
}
