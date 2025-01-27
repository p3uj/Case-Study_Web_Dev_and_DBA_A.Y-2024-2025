<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AddReviewController extends Controller
{
    public function index()
    {
        // Execute the stored procedure RE_SP_GET_ALL_TENANT
        $tenants = DB::select('EXEC RE_SP_GET_ALL_TENANT');

        // Send the tenants data to the view
        return view('components.add-review', compact('tenants'));
    }
}
