<?php

namespace App\Http\Controllers;
use App\Models\Reviews;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    private function reviewsReceivedByUserId($userId) {
        $userId = Auth::id();
        $userRole = Auth::user()->role;
        if ($userRole == 'Tenant') {
            // Fetch properties the tenant should review
            $toReview=Reviews::getPropertiesToReview($userId);
        } else {
            // Fetch tenants the landlord should review
            $toReview=Reviews::getTenantsToReview($userId);
        }

        return $toReview;
    }

    public function index() {
        $toReview = $this->reviewsReceivedByUserID(Auth::id());

        Log::info('Reviews Data:', ['toReview' => $toReview, 'userRole' => Auth::user()->role]);

        return view('review', [
            'toReview' => $toReview
            ,'userRole' => Auth::user()->role
        ]);
    }
}