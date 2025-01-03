<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function userInfo(){
        return view('user-profile', [
            'user' => Auth::user()
        ]);
    }
}
