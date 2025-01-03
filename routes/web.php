<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;

// Ensure that the authenticated user are the only one who can access the following routes.
Route::middleware('auth')->group(function () {
    Route::view('/home', 'home')->name('homepage');
    Route::view('/property', 'properties')->name('propertiespage');
    Route::view('/findroommateortenant', 'find-roommate-or-tenant')->name('findroommateortenantpage');
    Route::view('/postaproperty', 'post-a-property')->name('postapropertypage');
    Route::view('/review', 'review')->name('reviewpage');
    Route::get('/userprofile', [UserProfileController::class, 'userInfo'])->name('userprofilepage');
    // Route::view('/userprofile', 'user-profile')->name('userprofilepage');
});

// Ensure that only the unauthenticated user are the only one who can access this root route.
Route::middleware('guest')->get('/', function () {
    return view('Auth/login');
});

// Authentication routes
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginpost'])->name('login.post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
