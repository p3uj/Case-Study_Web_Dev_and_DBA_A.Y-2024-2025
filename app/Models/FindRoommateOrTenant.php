<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FindRoommateOrTenant extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getUserInfoAndItsFindingPost(){
        $posts = DB::table('find_roommate_or_tenants as find_post')
                    ->join('users', 'find_post.user_id', '=', 'users.id')
                    ->select('find_post.*', 'users.firstname', 'users.lastname')
                    ->orderByDesc('find_post.date_posted')
                    ->get();

        // Convert date_posted to Carbon instance
        $posts->each(function ($post) {
            $post->date_posted = \Carbon\Carbon::parse($post->date_posted);
        });

        return $posts;
    }
}
