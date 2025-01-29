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

    public static function getAllFindingPosts(){
        // Query the database
        $posts = DB::select('EXEC RE_SP_GET_ALL_AVAILABLE_ROOMMATES_TENANTS_POST');

        // Call the formatDate method in the DateConversion class, passing the $posts and the column name 'updated_at'
        $posts = DateConversion::formatDate($posts, 'updated_at');

        return $posts;
    }

    public static function getAllRoommateTenantPostsByUserId($userId) {
        // Fetch the finding post for the authenticated user
        $userRoommateTenantPosts = DB::select('EXEC RE_SP_GET_ALL_ROOMMATES_TENANTS_POSTS_BY_USERID ?', [$userId]);

        // Call the formatDate method in the DateConversion class, passing the $posts and the column name 'updated_at'
        $userRoommateTenantPosts = DateConversion::formatDate($userRoommateTenantPosts, 'updated_at');

        return $userRoommateTenantPosts;
    }

    public static function getRoommateTenantPostsById($id) {
        // Retrieve the city, barangay and description of the roommate tenant post based on the id for displaying it to the edit-find-roommate-tenant-post
        $post = DB::select('RE_SP_GET_ROOMMATE_TENANT_BY_ID ?', [$id]);

        return $post[0];
    }
}
