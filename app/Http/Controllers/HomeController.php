<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $featured = DB::select('EXEC RE_SP_GET_FEATURED_PROPERTIES');

        $properties = DB::select('EXEC RE_SP_GET_ALL_PROPERTY_POST_INFO_RATING');

        // Loop through the array and format the Rating
        foreach ($properties as $property) {
            if (isset($property->Rating)) {
                $property->Rating = number_format((float) $property->Rating, 2, '.', '');  // Format as 0.00
            } else {
                $property->Rating = '0.00';  // Ensure it defaults to 0.00 if not set
            }
        }

        $topRated = DB::select('EXEC RE_SP_GET_TOP_RATED_PROPERTIES');

        return view('home', ['featured' => $featured, 'properties' => $properties, 'topRated' => $topRated]);
    }
}
