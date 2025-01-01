<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/home', function () {
    return view('home');
})->name("homepage");

Route::get('/properties', function () {
    return view('Properties');
})->name("propertiespage");

Route::get('/find-roommate-or-tenant', function () {
    return view('find-Roommate-or-Tenant');
})->name("findroommateortenantpage");

Route::get('/post-a-property', function () {
    return view('post-A-Property');
})->name("postapropertypage");

Route::get('/review', function () {
    return view('review');
})->name("reviewpage");

Route::get('/userprofile', function () {
    return view('user-profile');
})->name("userprofilepage");
