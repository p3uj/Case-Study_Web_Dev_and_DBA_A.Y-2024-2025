<?php

namespace App\Http\Controllers;

use App\Models\PropertyPost;
use Illuminate\Http\Request;

class ViewPropertyPost extends Controller
{
    public function index($propertyPostid, $propertyInfoId)
    {
        // Call the getAllPropertyDetailsById and getAllUnitPhotosById method in the model to get the data
        $propertyPostDetails = PropertyPost::getAllPropertyDetailsById($propertyPostid);
        $propertyUnitPhotos = PropertyPost::getAllUnitPhotosById($propertyInfoId);

        //dd($propertyPostDetails);

        return view('view-property-post', [
            'propertyDetails' => $propertyPostDetails
            ,'propertyUnitPhotos' => $propertyUnitPhotos
        ]);
    }
}
