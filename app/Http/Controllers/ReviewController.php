<?php

namespace App\Http\Controllers;
use App\Models\Reviews;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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

        return view('review', ['toReview' => $toReview, 'userRole' => $userRole]);
    }

    public function edit(Request $request)
    {
        $review = $request;

        dd($request->all());

        return $review;
    }

}