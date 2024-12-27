<?php

use Illuminate\Support\Facades\Route;

// Serve login.html for the login page
Route::get('/', function () {
    return response()->file(public_path('html/login.html'));
});
