<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
    public static function getUserPropertyPost(){
        // Get the property posts with related PropertyInfo and Reviews based on the id of the authenticated user
        return self::where('user_id', Auth::id())->with(['propertyInfo', 'reviews'])->get();
    }

    // Average the ratings from reviews
    public function averageRating(){
        return $this->reviews->avg('rating');
    }
}
