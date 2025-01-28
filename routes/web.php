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
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AddReviewController;

use App\Http\Controllers\ViewPropertyPost;
use App\Http\Controllers\WriteReviewController;

// Ensure that the authenticated users are the only ones who can access the following routes.
Route::middleware('auth')->group(function () {
    Route::view('/home', 'home')->name('homepage');
    //Route::view('/property', 'properties')->name('propertiespage');
    //Route::view('/findroommateortenant', 'find-roommate-or-tenant')->name('findroommateortenantpage');
    Route::view('/postaproperty', 'post-a-property')->name('postapropertypage');
    Route::get('/review', [ReviewController::class, 'index'])->name('reviewpage');
    Route::get('/userprofile', [UserProfileController::class, 'index'])->name('userprofilepage');
    Route::get('/property', [PropertyController::class, 'index'])->name('propertiespage');
    Route::get('/findroommateortenant', [FindRoommateOrTenantController::class, 'index'])->name('findroommateortenantpage');
    // Route to show the create review modal as a new page
    Route::get('/add-review', [AddReviewController::class, 'index'])->name('add.review.page');
    Route::get('/write-review/{id}', [WriteReviewController::class, 'index'])->name('write.reviewpage');

    Route::get('viewproperty/{id}/{property_info_id}', [ViewPropertyPost::class, 'index'])->name('viewpropertypostpage');

    // Post routes
    Route::post('/findroommateortenant', [FindRoommateOrTenantController::class, 'store'])->name('findroommateortenant.post');
    Route::post('/property', [PropertyController::class, 'storeOrFilterSearch'])->name('property.post');
    Route::post('/submit-review', [AddReviewController::class, 'submitReview'])->name('submit.review');

});

// Ensure that only unauthenticated users can access this root route.
Route::middleware('guest')->group(function () {
    Route::view('/', 'Auth/login');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginpost'])->name('login.post');
});


// Authentication routes
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginpost'])->name('login.post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Registration routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
