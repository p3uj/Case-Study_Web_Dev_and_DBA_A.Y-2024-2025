<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class PendingRentalsController extends Controller
{
    public function index()
    {
        return view('pending-rentals');
    }
}
