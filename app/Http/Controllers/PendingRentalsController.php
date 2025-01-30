<?php

namespace App\Http\Controllers;
use App\Models\Reviews;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendingRentalsController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $userRole = Auth::user()->role;

        $rentedProperties = DB::select('EXEC RE_SP_GET_USER_PENDING_RENTALS ?', [$userId]);

        return view('pending-rentals', ['rentedProperties' => $rentedProperties, 'userRole' => $userRole]);
    }

    public function updateLeaseStatus(Request $request)
    {
        $reviewId = $request->input('reviewId');
        $postId = $request->input('postId');
        $isAvailable = 1;
        $leaseEnd = now();

        DB::statement('EXEC RE_SP_UPDATE_AVAILABILITY_ENDLEASE ?, ?, ?, ?', [
            $reviewId, $postId, $isAvailable, $leaseEnd
        ]);

        return redirect()->back();
    }
}