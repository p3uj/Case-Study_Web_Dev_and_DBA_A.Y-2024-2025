<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'role',
        'firstname',
        'lastname',
        'city',
        'email',
        'password',
        'profile_photo_path',
        'bio',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        //'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            //'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationship of database
    use HasFactory;

    public function findRoommateOrTenants()
    {
        return $this->hasMany(FindRoommateOrTenant::class);
    }

    public function propertyInfos()
    {
        return $this->hasMany(PropertyInfo::class);
    }

    public function propertyPosts()
    {
        return $this->hasMany(PropertyPost::class);
    }

    public function reviews()
    {
        return $this->hasMany(Reviews::class);
    }

    public static function getUserInfoById($id) {
        $userInfo = DB::select('EXEC GetUserInfoById ?', [$id]); // Used stored procedure and the return will be an array
        return $userInfo[0]; // Returning the first element of the result array, which contains the authenticated user's information
    }
}
