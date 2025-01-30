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
use App\Http\Controllers\EditSearchPost;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AddReviewController;
use App\Http\Controllers\EditPropertyPost;
use App\Http\Controllers\EditPropertyPostController;
use App\Http\Controllers\EditSearchPostController;
use App\Http\Controllers\PendingRentalsController;
use App\Http\Controllers\ViewPropertyPost;

// Ensure that the authenticated users are the only ones who can access the following routes.
Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('homepage');
    //Route::view('/property', 'properties')->name('propertiespage');
    //Route::view('/findroommateortenant', 'find-roommate-or-tenant')->name('findroommateortenantpage');
    Route::get('/pendingrentals', [PendingRentalsController::class, 'index'])->name('pendingrentalspage');
    Route::get('/review', [ReviewController::class, 'index'])->name('reviewpage');
    Route::get('/userprofile', [UserProfileController::class, 'index'])->name('userprofilepage');
    Route::get('/property', [PropertyController::class, 'index'])->name('propertiespage');
    Route::get('/findroommateortenant', [FindRoommateOrTenantController::class, 'index'])->name('findroommateortenantpage');
    // Route to show the create review modal as a new page
    Route::get('/add-review', [AddReviewController::class, 'index'])->name('add.review.page');

    Route::get('viewproperty/{id}/{property_info_id}', [ViewPropertyPost::class, 'index'])->name('viewpropertypostpage');
    Route::get('editsearchpost/{id}', [EditSearchPostController::class, 'index'])->name('editsearchpostpage');
    Route::get('userprofile/{id}/{found}/{deleted}', [EditSearchPostController::class, 'updateFoundOrDelete'])->name('userprofilepage.updatefoundordeleted');
    Route::get('editpropertypost/{id}{property_info_id}', [EditPropertyPostController::class, 'index'])->name('editpropertypostpage');
    Route::get('userprofile/deleteproperty/{id}/{available}/{deleted}', [EditPropertyPostController::class, 'delete'])->name('userprofilepage.deletepropertypost');

    // Post routes
    Route::post('/findroommateortenant', [FindRoommateOrTenantController::class, 'store'])->name('findroommateortenant.post');
    Route::post('/property', [PropertyController::class, 'storeOrFilterSearch'])->name('property.post');
    Route::post('editsearchpost', [EditSearchPostController::class, 'update'])->name('editsearchpost.post');
    Route::post('/submit-review', [AddReviewController::class, 'submitReview'])->name('submit.review');
    Route::post('editpropertypost', [EditPropertyPostController::class, 'update'])->name('editpropertypost.post');

    Route::put('/write-review', [ReviewController::class, 'writeReview'])->name('writereview');
    Route::put('/update-lease', [PendingRentalsController::class, 'updateLeaseStatus'])->name('updatelease');
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

// Close button in Edit-find-roommate-tenant
Route::get('/user-profile', [UserProfileController::class, 'index'])->name('user-profile');

