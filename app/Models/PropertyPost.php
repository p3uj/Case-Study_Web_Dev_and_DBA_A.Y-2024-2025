<?php

namespace App\Models;

use App\Helpers\DateConversion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PropertyPost extends Model
{
    use HasFactory;

    protected $casts = [
        'date_posted' => 'datetime', // Ensure it's cast to a Carbon instance
    ];

    // Relationship of other tables in database
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function propertyInfo()
    {
        return $this->belongsTo(PropertyInfo::class);
    }

    public function reviews()
    {
        return $this->hasMany(Reviews::class);
    }

    // Retrieve all data from property post
    public static function getPropertyPostsByUserId($userId){
        $authUserPropertyPosts = DB::select('RE_SP_GET_PROPERTY_POSTS_WITH_RATINGS_BY_USER_ID ?', [$userId]); // Used stored procedure and the return will be an array

        // Call the formatDate method in the DateConversion class, passing the $authUserPropertyPosts and the column name 'updated_at'
        $authUserPropertyPosts = DateConversion::formatDate($authUserPropertyPosts, 'updated_at');

        return $authUserPropertyPosts;
    }

    // Retrieve all property posts based on the filter search
    public static function getAllFilteredPropertyPosts($unitCategory = null, $city = null, $rentalPrice = null) {
        $propertyPosts = DB::select('RE_SP_GET_ALL_PROPERTY_POST_BASED_ON_FILTER_SEARCH ?, ?, ?', [
            $unitCategory
            ,$city
            ,$rentalPrice
        ]);

        return $propertyPosts;
    }

    // Retrieve property post and its details based on the property post id
    public static function getAllPropertyDetailsById($propertyPostId) {
        $propertyPostDetails = DB::select('RE_SP_GET_PROPERTY_DETAILS_BY_ID ?', [$propertyPostId]);

        // Call the formatDate method in the DateConversion class, passing the $authUserPropertyPosts and the column name 'updated_at'
        //$propertyPostDetails = DateConversion::formatDate($propertyPostId, 'updated_at');

        return $propertyPostDetails[0];
    }

    // Retrieve all unit photos of the property post based on the property info id
    public static function getAllUnitPhotosById($propertyInfoId) {
        $unitPhotos = DB::select('RE_SP_GET_ALL_PHOTOS_BY_ID ?', [$propertyInfoId]);

        return $unitPhotos;
    }
}
