<?php

use App\Http\Controllers\Api\BarangaysController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\FindRoommateOrTenantController;
use App\Http\Controllers\UserProfileController;
use App\Models\FindRoommateOrTenant;
use App\Models\PropertyPost;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;

// Ensure that the authenticated users are the only ones who can access the following routes.
Route::middleware('auth')->group(function () {
    Route::view('/home', 'home')->name('homepage');
    //Route::view('/property', 'properties')->name('propertiespage');
    //Route::view('/findroommateortenant', 'find-roommate-or-tenant')->name('findroommateortenantpage');
    Route::view('/postaproperty', 'post-a-property')->name('postapropertypage');
    Route::view('/review', 'review')->name('reviewpage');
    Route::get('/userprofile', [UserProfileController::class, 'index'])->name('userprofilepage');
    Route::get('/property', [PropertyController::class, 'index'])->name('propertiespage');
    Route::get('/findroommateortenant', [FindRoommateOrTenantController::class, 'index'])->name('findroommateortenantpage');

    // Post routes
    Route::post('/findroommateortenant', [FindRoommateOrTenantController::class, 'store'])->name('findroommateortenant.post');
    Route::post('/property', [PropertyController::class, 'store'])->name('property.post');
});

// Ensure that only unauthenticated users can access this root route.
Route::middleware('guest')->get('/', function () {
    return view('Auth/login');
});

// Authentication routes
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginpost'])->name('login.post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Registration routes
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register.post');
