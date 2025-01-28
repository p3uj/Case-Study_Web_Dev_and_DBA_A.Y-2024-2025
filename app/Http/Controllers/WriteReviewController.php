<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class WriteReviewController extends Controller
{
    public function index($id)
    {
        $review = DB::select('EXEC RE_SP_GET_REVIEW_BY_ID');

        return view('write-review', compact('review'));
    }
}