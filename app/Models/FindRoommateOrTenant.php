<?php

namespace App\Models;

use App\Helpers\DateConversion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FindRoommateOrTenant extends Model
{
    use HasFactory;

    protected $casts = [
        'date_posted' => 'datetime', // Ensure it's cast to a Carbon instance
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getAllFindingPostsWithUser(){
        // Query the database
        $posts = DB::select('EXEC GetAllFindingPostsWithUser');

        // Call the formatDate method in the DateConversion class, passing the $posts and the column name 'date_posted'
        $posts = DateConversion::formatDate($posts, 'date_posted');

        return $posts;
    }

    public static function getAuthUserFindingPost() {
        // Fetch the finding post for the authenticated user
        $userFindPost = self::where('user_id', Auth::id())->orderByDesc('date_posted')->get();

        return $userFindPost;
    }
}
