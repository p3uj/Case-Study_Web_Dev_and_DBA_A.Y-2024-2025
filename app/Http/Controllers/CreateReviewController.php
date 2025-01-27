<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateReviewController extends Controller
{
    public function index()
    {
        return view('components.create-review-modal'); // Your modal view
    }
}
