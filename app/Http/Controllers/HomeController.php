<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $featured = DB::select('EXEC RE_SP_GET_FEATURED_PROPERTIES');

        return view('home', ['featured' => $featured]);
    }
}