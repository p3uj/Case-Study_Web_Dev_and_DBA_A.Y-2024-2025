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
        $reviews = DB::select('EXEC GetAllReviewsByUserId ?', [$userId]);

        // Call the formatDate method in the DateConversion class, passing the $authUserPropertyPosts and the column name 'updated_at'
        $reviews = DateConversion::formatDate($reviews, 'updated_at');

        return $reviews;
    }
}
