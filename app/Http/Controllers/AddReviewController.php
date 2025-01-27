<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
}
