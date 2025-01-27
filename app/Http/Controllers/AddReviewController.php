<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AddReviewController extends Controller
{
    public function index()
    {
        // Execute the stored procedure RE_SP_GET_ALL_TENANT
        $tenants = DB::select('EXEC RE_SP_GET_ALL_TENANT');

        $userId = Auth::id();

        $properties = DB::select('EXEC RE_SP_GET_ALL_USER_PROPERTY ?', [$userId]);

        // Send the tenants data to the view
        return view('components.add-review', compact('tenants', 'properties'));
    }

    public function submitReview(Request $request)
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        // Get the current authenticated user's ID
        $userId = Auth::id();

        // Get data from AJAX request
        $tenantId = $request->input('tenantId');
        $propertyId = $request->input('propertyId');

        // Validate the input IDs
        if (empty($tenantId) || empty($propertyId)) {
            return response()->json(['message' => 'Tenant or Property ID missing'], 400);
        }

        try {
            // Call the stored procedure to create the first review (user as review_by and tenant as review_to)
            DB::select('CALL RE_SP_INSERT_REVIEW(?, ?, ?)', [
                $propertyId, // p_PPostId
                $userId,     // p_ReviewBy (user)
                $tenantId    // p_ReviewTo (tenant)
            ]);

            // Call the stored procedure to create the second review (tenant as review_by and user as review_to)
            DB::select('CALL RE_SP_INSERT_REVIEW(?, ?, ?)', [
                $propertyId, // p_PPostId
                $tenantId,   // p_ReviewBy (tenant)
                $userId      // p_ReviewTo (user)
            ]);
            
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error executing stored procedure', 'error' => $e->getMessage()], 500);
        }

        // Return a success response
        return response()->json(['message' => 'Reviews submitted successfully']);
    }
}
