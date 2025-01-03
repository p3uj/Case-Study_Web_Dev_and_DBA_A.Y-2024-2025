<?php

namespace App\Http\Controllers;

use App\Models\PropertyInfo;
use App\Models\PropertyPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class UserProfileController extends Controller
{
    public function userInfo(){
        return view('user-profile', [
            'user' => Auth::user()
        ]);
    }

    function propertyPost(){
        // Call the PropertyPost model to get the property posts of the authenticated user
        $propertyPost = PropertyPost::getUserPropertyPost();

        return view('user-profile', [
            'user' => Auth::user(),
            'properties' => $propertyPost
        ]);
    }
}
