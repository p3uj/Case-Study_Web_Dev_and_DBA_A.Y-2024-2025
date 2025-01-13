<?php

namespace App\Http\Controllers;

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

    private function reviewsReceivedByAuthUser() {
        // Call the getAllReviewsForAuthUser() method in the Reviews model to fetch all the reviews that received by authenticated user
        $reviewReceived = Reviews::getAllReviewsForAuthUser();

        return $reviewReceived;
    }

    public function index() {
        // Call the getUserAuthInfo method in the User model to fetch the info of the authenticated user
        $userInfo = User::getUserAuthInfo();

        // Call the propertyPost method to fetch the property post of an authenticated user
        $properties = $this->propertyPost();

        // Call the findRoommateOrTenantPost() method to fetch the post for the authenticated user
        $findingPost = $this->findRoommateOrTenantPost();

        // Call the reviewsReceivedByAuthUser() method to fetch all the reviews that the authenticated user received
        $reviews = $this->reviewsReceivedByAuthUser();

        return view('user-profile', [
            'user' => $userInfo
            ,'propertyPost' => $properties
            ,'findPost' => $findingPost
            ,'reviews' => $reviews
        ]);
    }
}
