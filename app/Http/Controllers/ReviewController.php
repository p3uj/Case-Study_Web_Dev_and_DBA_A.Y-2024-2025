<?php

namespace App\Http\Controllers;
use App\Models\Reviews;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    private function properties($userId) {
        // Call the PropertyPost model to get the property posts of the authenticated user
        $properties = Reviews::getPropertiesToReview($userId);

        return $properties;
    }

    private function tenants($userId) {
        // Call the PropertyPost model to get the property posts of the authenticated user
        $tenants = Reviews::getTenantsToReview($userId);

        return $tenants;
    }

    private function reviews($userId) {
        // Call the PropertyPost model to get the property posts of the authenticated user
        $reviews = Reviews::getUserReviews($userId);

        return $reviews;
    }

    public function index()
    {
        $userId = Auth::id();
        $userRole = Auth::user()->role;

        if ($userRole == 'Tenant') {
            // Fetch properties the tenant should review
            $toReview = $this->properties($userId);
        } else {
            // Fetch tenants the landlord should review
            $toReview = $this->tenants($userId);
        }

        $reviews = $this->reviews($userId);
        
        return view('review', ['toReview' => $toReview, 'userRole' => $userRole, 'reviews' => $reviews]);
    }

    public function writeReview(Request $request)
    {
        // Get values from the request
        $reviewId = $request->input('review-id');
        $reviewText = $request->input('review-text');
        $rating = $request->input('rating');
        $isReviewed = 1;
        $isEdited = $request->input('isEdited');


        // Call the stored procedure
        DB::statement('EXEC RE_SP_UPDATE_REVIEW ?, ?, ?, ?, ?', [
            $reviewId, $rating, $reviewText, $isReviewed, $isEdited
        ]);

        // Send the tenants data to the view
        return redirect()->back();
    }

}