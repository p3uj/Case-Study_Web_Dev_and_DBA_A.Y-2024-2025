<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Reviews extends Model
{
    use HasFactory;

    public function propertyPost()
    {
        return $this->belongsTo(PropertyPost::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getAllReviewsForAuthUser() {
        $reviews = DB::table('property_posts AS PPost')
                    // ->join('users AS PPostOwner', 'PPost.user_id', '=', 'PPostOwner.id') // Inner join
                    ->join('reviews AS R', 'PPost.id', '=', 'R.property_post_id') // Inner join
                    ->join('users AS ReviewByUser', 'R.user_id', '=', 'ReviewByUser.id')
                    ->where('PPost.user_id', '=', DB::raw(Auth::id()))
                    ->select('ReviewByUser.firstname', 'ReviewByUser.lastname'
                            ,'R.date_review'
                            ,'R.rating'
                            ,'R.review_text')
                    ->orderByDesc('R.date_review')
                    ->get();

        // Convert date_posted to Carbon instance
        $reviews->each(function ($review) {
            $review->date_review = \Carbon\Carbon::parse($review->date_review);
        });

        return $reviews;
    }
}
