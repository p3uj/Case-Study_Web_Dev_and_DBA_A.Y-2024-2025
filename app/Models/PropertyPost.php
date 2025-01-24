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
        $authUserPropertyPosts = DB::select('EXEC GetPropertyPostsByUserId ?', [$userId]); // Used stored procedure and the return will be an array

        // Call the formatDate method in the DateConversion class, passing the $authUserPropertyPosts and the column name 'updated_at'
        $authUserPropertyPosts = DateConversion::formatDate($authUserPropertyPosts, 'updated_at');

        return $authUserPropertyPosts;
    }

    public static function getAllPropertyPostByFilterSearch($unitCategory = null, $city = null, $rentalPrice = null) {
        $propertyPosts = DB::select('RE_SP_GET_ALL_PROPERTY_POST_BASED_ON_FILTER_SEARCH ?, ?, ?', [
            $unitCategory
            ,$city
            ,$rentalPrice
        ]);

        return $propertyPosts;
    }
}
