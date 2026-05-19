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
        return view('add-review', compact('tenants', 'properties'));
    }

    public function submitReview(Request $request)
    {
        $tenantId = $request->input('tenant_id');
        $propertyId = $request->input('property_id');
        $landlordId = Auth::id();

        try {
            // Call the stored procedure to create the first review (user as review_by and tenant as review_to)
            DB::statement('EXEC RE_SP_INSERT_REVIEW @p_PPostId = ?, @p_ReviewBy = ?, @p_ReviewTo = ?', [
                $propertyId,              // PropertyPostId (null for the first review)
                $landlordId,      // p_ReviewBy (user)
                $tenantId         // p_ReviewTo (tenant)
            ]);

            // Call the stored procedure to create the second review (tenant as review_by and user as review_to)
            DB::statement('EXEC RE_SP_INSERT_REVIEW @p_PPostId = ?, @p_ReviewBy = ?, @p_ReviewTo = ?', [
                $propertyId,      // PropertyPostId (not null for the second review)
                $tenantId,        // p_ReviewBy (tenant)
                $landlordId       // p_ReviewTo (user)
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error executing stored procedure', 'error' => $e->getMessage()], 500);
        }
    
        // Redirect the user back to their profile page
        return redirect()->route('userprofilepage')->with('message', 'Reviews submitted successfully!');
    }    
}