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

Route::get('/findroommateortenant', function () {
    return view('findRoommateorTenant');
})->name("findroommateortenantpage");

Route::get('/postaproperty', function () {
    return view('postAProperty');
})->name("postapropertypage");

Route::get('/aboutus', function () {
    return view('aboutUs');
})->name("aboutuspage");
