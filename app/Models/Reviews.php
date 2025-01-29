<?php

namespace App\Models;

use App\Helpers\DateConversion;
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

    public static function getAllReviewsForAUser($userId) {
        $reviews = DB::select('EXEC RE_SP_GET_ALL_REVIEWS_BY_USER_ID ?', [$userId]);

        // Call the formatDate method in the DateConversion class, passing the $authUserPropertyPosts and the column name 'updated_at'
        $reviews = DateConversion::formatDate($reviews, 'updated_at');

        return $reviews;
    }

    public static function getPropertiesToReview($userId) {
        $properties = DB::select('EXEC RE_SP_GET_PROPERTIES_TO_BE_REVIEWED ?', [$userId]);
        return $properties;
    }

    public static function getTenantsToReview($userId) {
        $tenants = DB::select('EXEC RE_SP_GET_TENANTS_TO_BE_REVIEWED ?', [$userId]);
        
        return $tenants;
    }

    public static function getUserReviews($userId) {
        $reviews = DB::select('EXEC RE_SP_GET_ALL_REVIEWS_WRITTEN_BY_USER ?', [$userId]);
        
        return $reviews;
    }
}