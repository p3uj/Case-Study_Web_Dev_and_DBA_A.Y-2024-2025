<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        // If the user already authenticated, redirect to the home page.
        if(Auth::check()){
            return redirect(route("homepage"));
        }
        return view("auth.login");
    }

    function loginpost(Request $request){
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);
        $credentials = $request->only("email", "password");

        // If the user entered correct credentials... redirect to home page.
        if(Auth::attempt($credentials)){
            return redirect()->intended(route("homepage"));
        }
        // If the credentials is incorrect.. it should show error and redirect to login page.
        return redirect(route("login"))->with("error","Login failed");
    }

    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route("login"));
    }
}
